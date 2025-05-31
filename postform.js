document.addEventListener('DOMContentLoaded', () => {
  const postBtn = document.getElementById('postBtn'); // your nav "Post" button
  const modal = document.getElementById('overlayForm');
  const closeBtn = document.querySelector('.closeBtn');
  const cancelBtn = document.getElementById('cancelBtn');

  // Open modal
  if (postBtn) {
    postBtn.addEventListener('click', () => {
      modal.style.display = 'block';
    });
  }

  // Close modal
  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  cancelBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Close if user clicks outside modal
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
});
