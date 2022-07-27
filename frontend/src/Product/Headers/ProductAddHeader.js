import {useNavigate} from "react-router-dom";

function ProductAddHeader({onSaveClicked}) {
    const navigate = useNavigate();

    return (
        <>
            <div className="d-flex justify-content-between">
                <h2>📝 Product Add</h2>
                <div>
                    <button className="btn btn-outline-primary" onClick={onSaveClicked}>Save</button>
                    <button className="ms-3 btn btn-light" onClick={event => navigate("/")}>Cancel</button>
                </div>
            </div>

            <hr/>
        </>
    );
}

export default ProductAddHeader;
