# Utiliser une image de base Node.js pour la construction de l'application React
FROM node:18 as build

# Définir le répertoire de travail
WORKDIR /app

# Copier package.json et package-lock.json (ou yarn.lock) pour installer les dépendances
COPY package*.json ./

# Installer les dépendances de React
RUN npm install

# Copier tout le reste du code de l'application React
COPY . .

# Construire l'application React (produit la version de production)
RUN npm run build

# Étape 2 : Serveur Nginx pour servir l'application React construite
FROM nginx:alpine

# Copier les fichiers construits dans le dossier public de Nginx
COPY --from=build /app/build /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf 
# Exposer le port 80 pour accéder à l'application React
EXPOSE 80

# Lancer Nginx en mode foreground
CMD ["nginx", "-g", "daemon off;"]
