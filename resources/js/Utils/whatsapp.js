export function validateAndSanitizePhoneNumber(phoneNumber) {
  const validPhoneNumberRegex = /^\d{12}$/; // Example: 12-digit phone number
  if (!validPhoneNumberRegex.test(phoneNumber)) {
    throw new Error('Invalid phone number');
  }

  const sanitizedPhoneNumber = phoneNumber.replace(/[^0-9]/g, '');
  return sanitizedPhoneNumber;
}
