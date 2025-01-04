import { useState } from "react";

const BtnPostAdd = ({ FormComponents }) => {
  const [showForm, setShowForm] = useState(false);

  const handleClick = () => {
    setShowForm(true);
  };

  return (
    <>
      {showForm ? (
        FormComponents.map((Component, index) => <Component key={index} />)
      ) : (
        <button
          onClick={handleClick}
          className="btn btn-success btn-lg shadow-lg rounded-pill px-3 py-1"
        >
          Post Add
        </button>
      )}
    </>
  );
};

export default BtnPostAdd;
