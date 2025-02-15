import React from "react";

const WalkCard = ({ walk }) => {
  return (
    <div
      className="card"
      style={{
        width: "100%",
        maxWidth: "500px",
        height: "350px",
        cursor: "pointer",
      }}
    >
      <div className="position-relative">
        <img
          src={`${process.env.REACT_APP_API_URL}media/${walk.ad.photo.filePath}`}
          className="card-img-top"
          alt="Walk"
          style={{ height: "200px", objectFit: "cover" }}
        />
        {/* Badge */}

        <div
          className="position-absolute top-0 start-0 m-2"
          style={{ zIndex: 1 }}
        >
          <span className="badge bg-success rounded-circle p-3"> </span>
        </div>

        {/* Image sous le badge */}
        <div className="position-absolute bottom-0 start-0 mb-4 ms-2">
          <img
            src="/images/sablier.png"
            alt="Additional Image"
            style={{
              width: "50px",
              height: "50px",
              objectFit: "contain",
            }}
          />
          <p>5h</p>
        </div>
      </div>
      <div className="card-body" style={{ padding: "10px" }}>
        <p className="card-text text-muted" style={{ marginBottom: "5px" }}>
          le : {new Date(walk.date).toLocaleDateString()} à{walk.time}
        </p>
        {/* <h5 className="card-location" style={{ marginBottom: "5px" }}>
          {walk.location}
        </h5> */}
        <p className="card-title" style={{ marginBottom: "5px" }}>
          {walk.ad.title}
        </p>
        <p className="card-text" style={{ marginBottom: "5px" }}>
          {walk.ad.description}
        </p>
      </div>
    </div>
  );
};

export default WalkCard;
