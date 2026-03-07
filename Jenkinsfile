pipeline {
  agent any

  options {
    timestamps()
    disableConcurrentBuilds()
    buildDiscarder(logRotator(numToKeepStr: '20'))
  }

  parameters {
    booleanParam(name: 'DEPLOY', defaultValue: true, description: 'Run Ansible deploy after upload')
  }

  environment {
    APP_NAME = 'katsana-api-explorer'
    BUILD_TS = ''
    DOCKER_IMAGE = "api-explorer-builder:${env.BUILD_NUMBER}"
    ARTIFACT_NAME = ''
    RELEASE_DIR = 'build/release'
    DEPLOY_ENV = 'production'
    AWS_REGION = 'ap-southeast-1'
    S3_BUCKET = 'katsana-releases'
    S3_PREFIX = 'production/api-explorer'
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

        sh '''
          set -euo pipefail
          test -f "build/$(cat .artifact_name)"
        '''
      }
    }

    stage('Upload Artifact to S3') {
      steps {
        withAWS(region: "${AWS_REGION}", credentials: 'aws-release') {
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
        withAWS(region: "${AWS_REGION}", credentials: 'aws-release') {
          withCredentials([file(credentialsId: 'ansvault', variable: 'ANSIBLE_VAULT_PASSWORD_FILE')]) {
            script {
              ansiblePlaybook(
                playbook: '/opt/ansible/playbooks/deploy_api_explorer_production.yml',
                inventory: '/opt/ansible/inventories/production.ini',
                extras: "--vault-password-file=${ANSIBLE_VAULT_PASSWORD_FILE}",
                colorized: true,
                extraVars: [
                  deploy_env: "${DEPLOY_ENV}",
                  build_number: "${env.BUILD_NUMBER}"
                ]
              )
            }
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
      cleanWs(cleanWhenNotBuilt: false)
    }
  }
}
