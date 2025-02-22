const { createProxyMiddleware } = require("http-proxy-middleware");

module.exports = function (app) {
  app.use(
    "/api", // Préfixe des requêtes à proxifier (toutes les requêtes vers /api seront proxyfiées)
    createProxyMiddleware({
      target: "https://woofwalks-api:8000", // URL du backend Symfony
      changeOrigin: true, // Indispensable pour le CORS
      secure: false, // À mettre à true en production si vous utilisez un certificat valide
    })
  );
};
