function Loading({ isLoading }) {
  const LoadingUi = () => {
    return (
      <div className="spinner-border" role="status">
        <span className="visually-hidden">Loading...</span>
      </div>
    );
  };

  return <>{isLoading ? <LoadingUi/> : null}</>;
}


export default Loading;