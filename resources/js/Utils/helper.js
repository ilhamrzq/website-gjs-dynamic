export default function formatTanggal(tanggalString) {
    if (!tanggalString) return "";

    const tanggal = new Date(tanggalString);
    const opsi = { day: "numeric", month: "long", year: "numeric" };
    return tanggal.toLocaleDateString("id-ID", opsi);
}
