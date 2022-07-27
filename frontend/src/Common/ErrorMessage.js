function UserError({field}) {
    return <div className="form-text text-danger"> Please, provide the data of indicated type `{field}` </div>
}

export default UserError;