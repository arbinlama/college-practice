const userTypeSelect = document.getElementById('userType');
const adminCodeField = document.getElementById('adminCode');

userTypeSelect.addEventListener('change', () => {
  if (userTypeSelect.value === 'admin') {
    adminCodeField.style.display = 'block';
  } else {
    adminCodeField.style.display = 'none';
  }
});