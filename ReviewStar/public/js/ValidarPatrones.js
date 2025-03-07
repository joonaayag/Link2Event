class ValidarPatrones {
    static validarDNI(dni) {
        const expresionDNI = /^[0-9]{8}[TWRAGMYFPDXBNJZSQVHLCKE]$/;
        return expresionDNI.test(dni);
    }

    static validarNIE(nie) {
        const expresionNIE = /^[XYZ][0-9]{7}[A-Z]$/;
        return expresionNIE.test(nie);
    }

    static validarEmail(email) {
        const expresionEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return expresionEmail.test(email);
    }
}