import React, {useEffect,useState} from 'react';
import ReactDOM from 'react-dom';

function Example() {

    const [state, setData] = useState({
        users: ''
    });

    const fetchData = async () => {
        const api = await fetch("/users");
        setData({
            users: await api.json()
        });
    };

    useEffect(() => {
        fetchData();
    }, [])

    console.log(state.users.data)

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">User List : CodeCheef</div>
                        <div className="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>1</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    state?.users?.data ?
                                        state?.users?.data?.map((user) => (
                                            <tr key={user?.id}>
                                                <td>{user?.id}</td>
                                                <td>{user?.name}</td>
                                                <td>{user?.email}</td>
                                            </tr>
                                        )) : "Loading..."
                                }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
