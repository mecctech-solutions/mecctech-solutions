USER root

# Ubuntu Noble ships php8.3, but symfony/filesystem and symfony/http-client
# in composer.lock require php >=8.4, so the vendor tree cannot boot on 8.3.
RUN set -eux; \
    mkdir -p /etc/apt/keyrings; \
    curl -fsSL "https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c" \
        | gpg --dearmor -o /etc/apt/keyrings/ondrej-php.gpg; \
    echo "deb [signed-by=/etc/apt/keyrings/ondrej-php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu noble main" \
        > /etc/apt/sources.list.d/ondrej-php.list; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        php8.4-cli php8.4-mbstring php8.4-xml php8.4-curl php8.4-sqlite3 \
        php8.4-mysql php8.4-zip php8.4-gd php8.4-bcmath php8.4-intl php8.4-pgsql; \
    rm -rf /var/lib/apt/lists/*; \
    curl -fsSL https://getcomposer.org/installer -o /tmp/composer-setup.php; \
    php8.4 /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
    rm /tmp/composer-setup.php; \
    php -v; \
    composer --version

USER yolo
