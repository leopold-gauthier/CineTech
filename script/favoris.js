imageElem.src = image;
imageElem.dataset.id = id;

imageElem.addEventListener('click', function() {
    window.location.href = 'detail.php?id=' + id + '&type=movie';
  });