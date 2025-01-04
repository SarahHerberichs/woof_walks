import React, { useState } from "react";

const PostUploadForm = () => {
  const [selectedFile, setSelectedFile] = useState(null);
  const [message, setMessage] = useState("");

  const handleFileChange = (event) => {
    setSelectedFile(event.target.files[0]);
  };

  const handleUpload = async () => {
    if (!selectedFile) {
      setMessage("Veuillez d'abord sélectionner un fichier");
      return;
    }

    const formData = new FormData();
    formData.append("file", selectedFile);

    try {
      const response = await fetch("https://localhost:8000/api/photos", {
        method: "POST",
        body: formData, // Le corps de la requête contient formData, pas de headers Content-Type requis ici
        headers: {
          // Optionnel si vous devez ajouter des en-têtes spécifiques
          Authorization: "Bearer votre_token", // Ajouter un token si vous utilisez l'authentification
        },
      });

      if (response.ok) {
        setMessage("File uploaded successfully");
      } else {
        // Si le serveur renvoie une erreur CORS, ce sera une erreur réseau
        setMessage(`Failed to upload file: ${response.statusText}`);
      }
    } catch (error) {
      if (error.message.includes("CORS")) {
        setMessage(
          "CORS error: The request was blocked by the server due to cross-origin policy."
        );
      } else {
        setMessage("Error: " + error.message);
      }
    }
  };

  return (
    <div>
      <h3>Upload a file</h3>
      <input type="file" onChange={handleFileChange} />
      <button onClick={handleUpload}>Upload</button>
      {message && <p>{message}</p>}
    </div>
  );
};

export default PostUploadForm;
