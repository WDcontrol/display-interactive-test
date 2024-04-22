import React, { ReactNode } from 'react';
import { Menu } from 'antd';
import { useNavigate } from 'react-router-dom';

interface AppLayoutProps {
    children: ReactNode;
}

const AppLayout: React.FC<AppLayoutProps> = ({ children }) => {
    const navigate = useNavigate();
    return (
        <div>

            <Menu
                style={{ display: 'flex', alignItems: 'center', padding: "10px 48px" }}
                selectable={false}
                theme="dark"
                mode="horizontal"
                items={[{ label: "Ugo", key: 1, onClick: () => { navigate("/") } }]}
            />

            <div style={{ padding: '48px' }}>
                {children}
            </div>

        </div>
    );
}

export default AppLayout;