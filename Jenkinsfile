pipeline {
  agent any

  options {
    timestamps()
    disableConcurrentBuilds()
    buildDiscarder(logRotator(numToKeepStr: '20'))
  }

  parameters {
    string(name: 'DEPLOY_ENV', defaultValue: 'production', description: 'Deployment environment name')
    string(name: 'AWS_REGION', defaultValue: 'ap-southeast-1', description: 'AWS region for S3/SSM')
    string(name: 'S3_BUCKET', defaultValue: 'katsana-releases', description: 'S3 bucket for artifacts')
    string(name: 'S3_PREFIX', defaultValue: 'production/api-explorer', description: 'S3 key prefix for artifacts')
    string(name: 'TARGET_HOST_GROUP', defaultValue: 'api_explorer_production', description: 'Ansible inventory host group')
    booleanParam(name: 'DEPLOY', defaultValue: true, description: 'Run Ansible deploy after upload')
    booleanParam(name: 'KEEP_WORKSPACE', defaultValue: false, description: 'Skip cleanWs and keep workspace after build')
  }

  environment {
    APP_NAME = 'katsana-api-explorer'
    BUILD_TS = ''
    DOCKER_IMAGE = "api-explorer-builder:${env.BUILD_NUMBER}"
    ARTIFACT_NAME = ''
    RELEASE_DIR = 'build/release'
  }

  stages {
    stage('Checkout') {
      steps {
        sshagent(['katsana-jenkins']) {
          checkout scm
        }
        sh '''
          set -euo pipefail
          echo "Jenkins WORKSPACE: ${WORKSPACE}"
          BUILD_TS="$(date -u +%Y%m%d_%H%M%S)"
          GIT_SHORT_SHA="$(git rev-parse --short=8 HEAD)"
          ARTIFACT_NAME="${APP_NAME}-${BUILD_TS}-${GIT_SHORT_SHA}.tar.gz"
          echo "${ARTIFACT_NAME}" > .artifact_name
        '''
        script {
          env.ARTIFACT_NAME = readFile('.artifact_name').trim()
        }
      }
    }

    stage('Build Artifact') {
      steps {
        sh '''
          set -euo pipefail

          ARTIFACT_NAME="$(cat .artifact_name)"
          test -n "${ARTIFACT_NAME}"
          test "${ARTIFACT_NAME}" != "null"
          mkdir -p "${RELEASE_DIR}" build
          docker build -f .docker/Dockerfile -t "${DOCKER_IMAGE}" .

          docker run --rm \
            -v "$PWD:/app" \
            -w /app \
            "${DOCKER_IMAGE}" \
            bash -lc '
              set -euo pipefail
              composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
              npm ci
              npm run build
            '

          rsync -a --delete \
            --exclude ".git" \
            --exclude ".github" \
            --exclude ".docker" \
            --exclude "deploy" \
            --exclude "node_modules" \
            --exclude "tests" \
            --exclude "storage/logs/*" \
            --exclude ".env" \
            --exclude "/build" \
            ./ "${RELEASE_DIR}/"

          tar -czf "build/${ARTIFACT_NAME}" -C "${RELEASE_DIR}" .
        '''

        script {
          def artifactName = readFile('.artifact_name').trim()
          sh '''
            set -euo pipefail
            test -f "build/$(cat .artifact_name)"
          '''
          archiveArtifacts artifacts: "build/${artifactName}", fingerprint: true
        }
      }
    }

    stage('Upload Artifact to S3') {
      steps {
        withAWS(region: "${params.AWS_REGION}", credentials: 'aws-release') {
          sh '''
            set -euo pipefail
            ARTIFACT_NAME="$(cat .artifact_name)"
            test -n "${ARTIFACT_NAME}"
            test "${ARTIFACT_NAME}" != "null"
            ARTIFACT_PATH="build/${ARTIFACT_NAME}"
            test -f "${ARTIFACT_PATH}"
            aws s3 cp "${ARTIFACT_PATH}" "s3://${S3_BUCKET}/${S3_PREFIX}/${ARTIFACT_NAME}"
            aws s3 cp "${ARTIFACT_PATH}" "s3://${S3_BUCKET}/${S3_PREFIX}/${APP_NAME}-latest.tar.gz"
          '''
        }
      }
    }

    stage('Deploy via Ansible') {
      when {
        expression { return params.DEPLOY }
      }
      steps {
        withCredentials([file(credentialsId: 'ansvault', variable: 'ANSIBLE_VAULT_PASSWORD_FILE')]) {
          script {
            def artifactName = readFile('.artifact_name').trim()
            if (!artifactName || artifactName == 'null') {
              error("Invalid artifact name: '${artifactName}'")
            }

            echo """ansible-playbook /opt/ansible/playbooks/deploy_api_explorer_production.yml \\
            -i /opt/ansible/inventories/production.ini \\
            --vault-password-file=\$ANSIBLE_VAULT_PASSWORD_FILE \\
            -e deploy_env=${params.DEPLOY_ENV} \\
            -e target_host_group=${params.TARGET_HOST_GROUP} \\
            -e aws_region=${params.AWS_REGION} \\
            -e artifact_bucket=${params.S3_BUCKET} \\
            -e artifact_key=${params.S3_PREFIX}/${artifactName} \\
            -e APP_WORKSPACE=${env.WORKSPACE} \\
            -e build_number=${env.BUILD_NUMBER} \\
            -e git_sha=${env.GIT_SHORT_SHA}"""
            
            ansiblePlaybook(
              playbook: '/opt/ansible/playbooks/deploy_api_explorer_production.yml',
              inventory: '/opt/ansible/inventories/production.ini',
              extras: "--vault-password-file=${ANSIBLE_VAULT_PASSWORD_FILE}",
              colorized: true,
              extraVars: [
                deploy_env: "${params.DEPLOY_ENV}",
                target_host_group: "${params.TARGET_HOST_GROUP}",
                aws_region: "${params.AWS_REGION}",
                artifact_bucket: "${params.S3_BUCKET}",
                artifact_key: "${params.S3_PREFIX}/${artifactName}",
                APP_WORKSPACE: "${env.WORKSPACE}",
                build_number: "${env.BUILD_NUMBER}",
                git_sha: "${env.GIT_SHORT_SHA}"
              ]
            )
          }
        }
      }
    }
  }

  post {
    success {
      echo "Build and deployment completed. Artifact: ${env.ARTIFACT_NAME}"
    }
    failure {
      echo 'Pipeline failed. Check stage logs for details.'
    }
    always {
      script {
        if (params.KEEP_WORKSPACE) {
          echo "Skipping workspace cleanup because KEEP_WORKSPACE=true. Workspace: ${env.WORKSPACE}"
        } else {
          cleanWs(cleanWhenNotBuilt: false)
        }
      }
    }
  }
}
