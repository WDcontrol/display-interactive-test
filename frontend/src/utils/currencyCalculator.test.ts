import { calculateTotalsByCurrency } from "./currencyCalculator";

interface Purchase {
    price: number;
    quantity: number;
    currency: string;
}

describe('calculateTotalsByCurrency', () => {
    it('should calculate correct totals for each currency', () => {
        const purchases: Purchase[] = [
            { price: 10, quantity: 2, currency: 'USD' },
            { price: 15, quantity: 1, currency: 'EUR' },
            { price: 7, quantity: 3, currency: 'USD' }
        ];
        const expected = {
            USD: 41,
            EUR: 15
        };
        const result = calculateTotalsByCurrency(purchases);
        expect(result).toEqual(expected);
    });
});
