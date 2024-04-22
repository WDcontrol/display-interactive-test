import React, { useEffect, useState } from 'react';
import { Table, TableColumnsType, Button, Typography } from 'antd';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';
import AppLayout from '../layouts/AppLayout';
import { calculateTotalsByCurrency } from "../utils/currencyCalculator";

interface Purchase {
    purchaseIdentifier: string;
    customerId: number;
    productId: number;
    quantity: number;
    price: number;
    currency: string;
    date: string;
}

const { Text } = Typography;

const CustomerDetailsPage: React.FC = () => {
    const { customerId } = useParams<{ customerId: string }>();
    const [purchases, setPurchases] = useState<Purchase[]>([]);
    const navigate = useNavigate();

    useEffect(() => {
        axios.get<Purchase[]>(`http://localhost:8000/customers/${customerId}/purchases`)
            .then(response => setPurchases(response.data))
            .catch(error => console.error('Error fetching purchases:', error));
    }, [customerId]);

    const columns: TableColumnsType<Purchase> = [
        { title: 'Purchase Identifier', dataIndex: 'purchaseIdentifier', key: 'purchaseIdentifier' },
        { title: 'Product ID', dataIndex: 'productId', key: 'productId' },
        { title: 'Quantity', dataIndex: 'quantity', key: 'quantity' },
        { title: 'Price', dataIndex: 'price', key: 'price' },
        { title: 'Currency', dataIndex: 'currency', key: 'currency' },
        { title: 'Date', dataIndex: 'date', key: 'date' },
    ];

    const totalsByCurrency = calculateTotalsByCurrency(purchases);

    return (
        <AppLayout>
            <Button style={{ marginBottom: "20px" }} onClick={() => navigate('/')}>Back to Customers</Button>
            <Table bordered dataSource={purchases} columns={columns} rowKey="purchaseIdentifier" />
            <div>
                {Object.entries(totalsByCurrency).map(([currency, total]) => (
                    <Text key={currency} strong style={{ display: 'block' }}>
                        Total in {currency}: {total.toFixed(2)}
                    </Text>
                ))}
            </div>
        </AppLayout>
    );
};

export default CustomerDetailsPage;
