export const formatCurrency = (price) =>
    Number(price).toLocaleString("es-MX", {
        style: "currency",
        currency: "MXN",
    });
