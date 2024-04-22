import React, { useEffect, useState } from 'react';
import { Table, TableColumnsType } from 'antd';
import { Link } from 'react-router-dom';
import axios from 'axios';
import AppLayout from '../layouts/AppLayout';

interface Customer {
    customerId: number;
    title: number;
    lastname: string;
    firstname: string;
    postalCode: string;
    city: string;
    email: string;
}

const CustomersPage: React.FC = () => {
    const [customers, setCustomers] = useState<Customer[]>([]);

    useEffect(() => {
        axios.get<Customer[]>('http://localhost:8000/customers')
            .then(response => setCustomers(response.data))
            .catch(error => console.error('Error fetching customers:', error));
    }, []);

    const columns: TableColumnsType<Customer> = [
        { title: 'ID', dataIndex: 'customerId', key: 'customerId' },
        { title: 'Title', dataIndex: 'title', key: 'title' },
        { title: 'Last Name', dataIndex: 'lastname', key: 'lastname' },
        { title: 'First Name', dataIndex: 'firstname', key: 'firstname' },
        { title: 'Postal Code', dataIndex: 'postalCode', key: 'postalCode' },
        { title: 'City', dataIndex: 'city', key: 'city' },
        { title: 'Email', dataIndex: 'email', key: 'email' },
        { title: 'Details', key: 'details', render: (_, record) => <Link to={`/${record.customerId}`}>View Purchases</Link> },
    ];

    return <AppLayout>
        <Table bordered dataSource={customers} columns={columns} rowKey="customerId" />
    </AppLayout>;
};

export default CustomersPage;
