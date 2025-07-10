#!/bin/bash

# ====== CONFIGURE THESE ======
REMOTE_USER="oxygenarabia"
REMOTE_HOST="oxygenarabia.com"
REMOTE_PATH="public_html/oxygenarabia-api"
SSH_PORT=22  # Change if your cPanel uses a custom SSH port
PASSWORD="MSActs@1981"  # ⚠️ Don't use this in production!
# =============================
sshpass -p "$PASSWORD" ssh -o StrictHostKeyChecking=no -p $SSH_PORT ${REMOTE_USER}@${REMOTE_HOST} << EOF
    echo "📂 Switching to project directory: $REMOTE_PATH"
    cd $REMOTE_PATH

    echo "📥 Pulling latest code from Git (master branch)"
    git pull origin master

    echo "🔄 Replacing .env with .env.production"
    cp .env.production .env

    echo "⚙️ Running Laravel post-deploy commands"
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan migrate --force

    echo "✅ Deployment complete!"
EOF
