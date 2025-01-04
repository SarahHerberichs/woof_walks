import BtnPostAdd from "../components/Buttons/BtnPostAdd";
import PostWalkForm from "../components/Forms/PostWalkForm";
import WalkList from "../components/Lists/WalkList";
const Walks = () => {
  return (
    <>
      <BtnPostAdd FormComponents={[PostWalkForm]} />
      <WalkList />
    </>
  );
};

export default Walks;
