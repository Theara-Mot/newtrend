<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Guideline - Docker & Kubernetes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.15);
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .step {
            margin-bottom: 40px;
        }

        .step-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: white;
        }

        .step-number {
            background: linear-gradient(135deg, #ff6b6b, #ff8e53);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        .step-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .code-block {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .code-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .code-title {
            color: #64ffda;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .copy-btn {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        .copy-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(76, 175, 80, 0.4);
        }

        .copy-btn:active {
            transform: translateY(0);
        }

        .copy-btn.copied {
            background: linear-gradient(135deg, #2196F3, #1976D2);
        }

        pre {
            color: #e8eaed;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.4;
            margin: 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .command {
            color: #81c784;
        }

        .comment {
            color: #9e9e9e;
        }

        .description {
            color: white;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .success-note {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.3);
            border-radius: 12px;
            padding: 15px;
            color: #81c784;
            margin: 15px 0;
        }

        .warning-note {
            background: rgba(255, 152, 0, 0.2);
            border: 1px solid rgba(255, 152, 0, 0.3);
            border-radius: 12px;
            padding: 15px;
            color: #ffb74d;
            margin: 15px 0;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 70%;
            right: 10%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            top: 40%;
            left: 80%;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .file-name {
            color: #ffab40;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .glass-card {
                padding: 20px;
            }
            
            .code-block {
                padding: 15px;
            }
            
            pre {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="header">
            <h1>🚀 Deployment Guide</h1>
            <p>Docker & Kubernetes on Kali Linux</p>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">1</div>
                    <div class="step-title">Install Docker on Kali</div>
                </div>
                
                <div class="description">
                    Set up Docker environment with all necessary components for containerization.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Update system and install Docker</div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-install')">Copy</button>
                    </div>
                    <pre id="docker-install"><span class="comment"># Update system</span>
sudo apt update && sudo apt upgrade -y

<span class="comment"># Install Docker</span>
sudo apt install -y docker.io

<span class="comment"># Start Docker service</span>
sudo systemctl start docker
sudo systemctl enable docker

<span class="comment"># Verify installation</span>
docker --version</pre>
                </div>

                <div class="warning-note">
                    <strong>Optional:</strong> Add your user to Docker group to avoid using sudo:
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Configure Docker user permissions</div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-user')">Copy</button>
                    </div>
                    <pre id="docker-user">sudo usermod -aG docker $USER
newgrp docker</pre>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">2</div>
                    <div class="step-title">Install Docker Compose</div>
                </div>
                
                <div class="description">
                    Docker Compose is essential for managing multi-container Laravel applications.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Install and verify Docker Compose</div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-compose')">Copy</button>
                    </div>
                    <pre id="docker-compose">sudo apt install -y docker-compose
docker-compose --version</pre>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">3</div>
                    <div class="step-title">Install Kubernetes (Minikube + kubectl)</div>
                </div>
                
                <div class="description">
                    Set up local Kubernetes environment using Minikube for development and testing.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Install kubectl</div>
                        <button class="copy-btn" onclick="copyCode(this, 'kubectl-install')">Copy</button>
                    </div>
                    <pre id="kubectl-install"><span class="comment"># Install kubectl</span>
curl -LO "https://dl.k8s.io/release/$(curl -s https://dl.k8s.io/release/stable.txt)/bin/linux/amd64/kubectl"
chmod +x kubectl
sudo mv kubectl /usr/local/bin/

<span class="comment"># Verify installation</span>
kubectl version --client</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Install and start Minikube</div>
                        <button class="copy-btn" onclick="copyCode(this, 'minikube-install')">Copy</button>
                    </div>
                    <pre id="minikube-install"><span class="comment"># Install Minikube</span>
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
sudo install minikube-linux-amd64 /usr/local/bin/minikube

<span class="comment"># Start Minikube using Docker driver</span>
minikube start --driver=docker</pre>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">4</div>
                    <div class="step-title">Dockerize Laravel Project</div>
                </div>
                
                <div class="description">
                    Create Docker configuration files for your Laravel application.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Create <span class="file-name">Dockerfile</span> in project root</div>
                        <button class="copy-btn" onclick="copyCode(this, 'dockerfile')">Copy</button>
                    </div>
                    <pre id="dockerfile">FROM php:8.2-fpm

<span class="comment"># Install system dependencies</span>
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev zip unzip

<span class="comment"># Install PHP extensions</span>
RUN docker-php-ext-install pdo pdo_mysql gd

<span class="comment"># Install Composer</span>
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

<span class="comment"># Set working directory</span>
WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]

EXPOSE 9000</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Create <span class="file-name">docker-compose.yml</span></div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-compose-yml')">Copy</button>
                    </div>
                    <pre id="docker-compose-yml">version: '3.8'
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - .:/var/www
    depends_on:
      - db
    networks:
      - laravel

  db:
    image: mysql:8
    environment:
      MYSQL_DATABASE: laravel
      MYSQL_ROOT_PASSWORD: root
      MYSQL_USER: laravel
      MYSQL_PASSWORD: secret
    ports:
      - "3306:3306"
    networks:
      - laravel

  nginx:
    image: nginx:alpine
    volumes:
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www
    ports:
      - "8000:80"
    depends_on:
      - app
    networks:
      - laravel

networks:
  laravel:</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Create <span class="file-name">nginx.conf</span></div>
                        <button class="copy-btn" onclick="copyCode(this, 'nginx-conf')">Copy</button>
                    </div>
                    <pre id="nginx-conf">server {
    listen 80;
    index index.php index.html;
    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }
}</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Run Docker Compose</div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-run')">Copy</button>
                    </div>
                    <pre id="docker-run">docker-compose up -d</pre>
                </div>

                <div class="success-note">
                    🎉 Laravel should now be available at: <strong>http://localhost:8000</strong>
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">5</div>
                    <div class="step-title">Deploy Laravel on Kubernetes</div>
                </div>
                
                <div class="description">
                    Convert Docker Compose configuration to Kubernetes manifests and deploy.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Install kompose converter</div>
                        <button class="copy-btn" onclick="copyCode(this, 'kompose-install')">Copy</button>
                    </div>
                    <pre id="kompose-install">sudo apt install -y kompose</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Convert and deploy to Kubernetes</div>
                        <button class="copy-btn" onclick="copyCode(this, 'k8s-deploy')">Copy</button>
                    </div>
                    <pre id="k8s-deploy"><span class="comment"># Convert Docker Compose to Kubernetes manifests</span>
kompose convert -f docker-compose.yml

<span class="comment"># Apply Kubernetes configurations</span>
kubectl apply -f .</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Expose service and access application</div>
                        <button class="copy-btn" onclick="copyCode(this, 'k8s-expose')">Copy</button>
                    </div>
                    <pre id="k8s-expose"><span class="comment"># Expose nginx service</span>
kubectl expose deployment nginx --type=NodePort --port=80

<span class="comment"># Open application in browser</span>
minikube service nginx</pre>
                </div>

                <div class="success-note">
                    🚀 <strong>Congratulations!</strong> Laravel is now running inside a Kubernetes cluster with Docker + Kubernetes deployment on Kali Linux.
                </div>
            </div>
        </div>

        <div class="glass-card">
            <div class="step">
                <div class="step-header">
                    <div class="step-number">✨</div>
                    <div class="step-title">Useful Commands</div>
                </div>
                
                <div class="description">
                    Additional commands for managing your deployment.
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Docker management commands</div>
                        <button class="copy-btn" onclick="copyCode(this, 'docker-mgmt')">Copy</button>
                    </div>
                    <pre id="docker-mgmt"><span class="comment"># View running containers</span>
docker ps

<span class="comment"># Stop all containers</span>
docker-compose down

<span class="comment"># Rebuild containers</span>
docker-compose up --build -d

<span class="comment"># View logs</span>
docker-compose logs -f</pre>
                </div>

                <div class="code-block">
                    <div class="code-header">
                        <div class="code-title">Kubernetes management commands</div>
                        <button class="copy-btn" onclick="copyCode(this, 'k8s-mgmt')">Copy</button>
                    </div>
                    <pre id="k8s-mgmt"><span class="comment"># View all pods</span>
kubectl get pods

<span class="comment"># View services</span>
kubectl get services

<span class="comment"># View deployment status</span>
kubectl get deployments

<span class="comment"># Delete all resources</span>
kubectl delete all --all</pre>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyCode(button, elementId) {
            const code = document.getElementById(elementId).textContent;
            navigator.clipboard.writeText(code).then(() => {
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.classList.add('copied');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('copied');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        // Add smooth scroll behavior
        document.querySelectorAll('.glass-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.glass-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>
</html>