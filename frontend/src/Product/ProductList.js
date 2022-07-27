import Product from "./Product";
import ProductListHeader from "./Headers/ProductListHeader";
import {useEffect, useState} from "react";
import {endpoint} from "../Config/Api";
import Loading from "../Common/Loading";

function ProductList() {
    const [loading, setLoading] = useState(true);
    const [products, setProducts] = useState([]);
    const [checkBoxRefs, setCheckBoxRefs] = useState([]);

    useEffect(() => {
        fetch(`${endpoint}/read.php`).then(res => res.json()).then(value => {
            setLoading(false);
            value.data && setProducts(value.data);
        }).catch(reason => {
            setLoading(false);
        });
    }, [])


    /**
     * iterates throw every checkbox and returns the checked ones
     * @returns {*[]}
     */
    const prepareProductToDelete = () => {
        const productToDelete = [];
        for(const key in checkBoxRefs){
            const val = checkBoxRefs[key];
            if(val.current.checked){
                productToDelete.push(key);
            }
        }
        return productToDelete;
    }

    const deleteProducts = () => {
        const productToDelete = prepareProductToDelete();
        if (productToDelete.length > 0) {
            fetch(`${endpoint}/delete.php`, {
                method: 'DELETE',
                body: JSON.stringify({
                    skus: productToDelete
                })
            }).then(value => {
                const newProducts = products.filter(product => productToDelete.indexOf(product.sku) === -1);
                setProducts(newProducts);
            })
        }
    }

    const registerCheckBoxRefs = (sku, newCheckBoxRef)=>{
        const prev = checkBoxRefs;
        prev[sku] = newCheckBoxRef;
        setCheckBoxRefs(prev);
    }

    return (
        <>
            <ProductListHeader onBatchDeleteClicked={deleteProducts}/>

            <div className="row gap-3 justify-content-center">
                {products.map((product) => {
                    return <Product key={product.sku} product={product} onRegisterCheckBoxRef={registerCheckBoxRefs}/>;
                })}
            </div>
            <div className="d-flex justify-content-center mt-3">
                <Loading isLoading={loading}/>
            </div>
        </>
    );
}

export default ProductList;
