import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import CustomersPage from './pages/CustomersPage';
import CustomerDetailsPage from './pages/CustomerDetailsPage';

const App: React.FC = () => {

  return (
    <Router>
      <Routes>
        <Route path="/" element={<CustomersPage />} />
        <Route path="/:customerId" element={<CustomerDetailsPage />} />
      </Routes>
    </Router>
  );
};

export default App;
