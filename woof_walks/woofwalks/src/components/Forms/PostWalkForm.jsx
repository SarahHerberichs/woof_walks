import React, { useState } from "react";

const CombinedPostForm = () => {
  // Inputs normaux
  const [walkFormData, setWalkFormData] = useState({
    title: "",
    description: "",
    date: "",
    time: "",
    max_participants: "",
  });

  const [selectedFile, setSelectedFile] = useState(null);
  const [message, setMessage] = useState("");
  const [walkData, setWalkData] = useState(null); // État pour stocker les données de la walk
  const [photoData, setPhotoData] = useState(null); // État pour stocker les données de la photo

  // Modification des données (clé-valeur)
  const handleWalkChange = (e) => {
    const { name, value } = e.target;
    setWalkFormData({ ...walkFormData, [name]: value });
  };

  const handleFileChange = (e) => {
    setSelectedFile(e.target.files[0]);
  };

  // Logique du submit
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!selectedFile) {
      setMessage("Veuillez sélectionner une photo avant de continuer.");
      return;
    }

    // Insertion de la photo dans le formData
    const photoFormData = new FormData();
    photoFormData.append("file", selectedFile);

    try {
      // Envoi de la photo
      const photoResponse = await fetch("https://localhost:8000/api/photos", {
        method: "POST",
        body: photoFormData,
      });

      if (!photoResponse.ok) {
        setMessage(
          `Erreur lors de l'upload de la photo: ${photoResponse.statusText}`
        );
        return;
      }

      const photoData = await photoResponse.json();
      setPhotoData(photoData); // Stocke les données de la photo dans l'état
      const photoId = photoData["@id"].split("/").pop(); // Récupère l'ID de la photo
      console.log("Photo ID:", photoId); // Affiche l'ID de la photo dans la console

      // Envoi de la walk
      const walkDataToSend = {
        ...walkFormData,
        max_participants: parseInt(walkFormData.max_participants, 10),
        description: walkFormData.description,
        title: walkFormData.title,
        time: walkFormData.time,
        date: walkFormData.date,
        created_at: new Date().toISOString(),
        updated_at: new Date().toISOString(),
      };

      const walkResponse = await fetch("https://127.0.0.1:8000/api/walks", {
        method: "POST",
        headers: {
          "Content-Type": "application/ld+json",
        },
        body: JSON.stringify(walkDataToSend),
      });

      if (!walkResponse.ok) {
        const errorResponse = await walkResponse.text();
        setMessage(
          `Erreur lors de l'enregistrement de la walk: ${errorResponse}`
        );
        return;
      }

      const walkData = await walkResponse.json();
      setWalkData(walkData); // Stocke les données de la walk dans l'état
      const walkId = walkData["@id"].split("/").pop(); // Récupère l'ID de la walk
      console.log("Walk ID:", walkId); // Affiche l'ID de la walk dans la console

      // Gestion du lien entre la walk et la photo
      const linkData = {
        walkId: walkId,
        photoId: photoId,
      };

      const linkResponse = await fetch(
        "https://localhost:8000/api/photo_entity",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(linkData),
        }
      );

      if (!linkResponse.ok) {
        const errorResponse = await linkResponse.text();
        setMessage(
          `Erreur lors de l'enregistrement dans photo_entity: ${errorResponse}`
        );
        return;
      }

      setMessage("Walk, photo et lien enregistrés avec succès !");
    } catch (error) {
      setMessage(`Erreur: ${error.message}`);
    }
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <h3>Créer une Walk avec Photo</h3>

        {/* Formulaire pour les données de la walk */}
        <input
          type="text"
          name="title"
          value={walkFormData.title}
          onChange={handleWalkChange}
          placeholder="Titre"
          required
        />
        <input
          type="text"
          name="description"
          value={walkFormData.description}
          onChange={handleWalkChange}
          placeholder="Description"
          required
        />
        <input
          type="date"
          name="date"
          value={walkFormData.date}
          onChange={handleWalkChange}
          placeholder="Date"
          required
        />
        <input
          type="time"
          name="time"
          value={walkFormData.time}
          onChange={handleWalkChange}
          placeholder="Heure"
          required
        />

        <input
          type="number"
          name="max_participants"
          value={walkFormData.max_participants}
          onChange={handleWalkChange}
          placeholder="Nombre de participants"
          required
        />

        {/* Formulaire pour la photo */}
        <input type="file" onChange={handleFileChange} required />

        <button type="submit">Envoyer</button>

        {message && <p>{message}</p>}
      </form>

      {/* Affichage des IDs récupérés */}
      {walkData && photoData && (
        <div>
          <h4>Résultats :</h4>
          <pre>
            {`ID de la photo : ${photoData["@id"]
              .split("/")
              .pop()}\nID de la walk : ${walkData["@id"].split("/").pop()}`}
          </pre>
        </div>
      )}
    </div>
  );
};

export default CombinedPostForm;
