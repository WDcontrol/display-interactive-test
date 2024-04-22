export const calculateTotalsByCurrency =
    (purchases: { price: number, quantity: number, currency: string }[]): Record<string, number> => {
        return purchases.reduce((acc: Record<string, number>, { price, quantity, currency }) => {
            const total = price * quantity;
            if (acc[currency]) {
                acc[currency] += total;
            } else {
                acc[currency] = total;
            }
            return acc;
        }, {});
    };
