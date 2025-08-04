export const fetchEvents = async (status, lang_id = 1, page = 1) => {
    try {
        const response = await fetch(
            `${
                import.meta.env.VITE_APP_URL
            }/api/events?status=${status}&lang_id=${lang_id}&page=${page}`
        );

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    } catch (err) {
        console.error(`Failed to fetch ${status} events:`, err.message);
        return null;
    }
};
