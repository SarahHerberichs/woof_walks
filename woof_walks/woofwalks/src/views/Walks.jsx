import BtnPostAdd from "../components/Buttons/BtnPostAdd";
import GenericPostForm from "../components/Forms/GenericPostForm";
import walkSpecificFields from "../components/Forms/walkSpecificFields";
import WalkList from "../components/Lists/WalkList";

const Walks = () => {
  const formComponents = [
    (props) => (
      <GenericPostForm {...props} entitySpecificFields={walkSpecificFields} />
    ),
  ];

  return (
    <>
      <BtnPostAdd
        formContext="walks" // Passage du contexte spécifique à 'walk'
        formComponents={formComponents} // Passer les composants génériques à afficher
      />
      <WalkList />
    </>
  );
};

export default Walks;
