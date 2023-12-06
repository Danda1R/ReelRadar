$(document).ready(function () {
  $('.star-button').on('click', function () {
    var isFilled = $(this).find('i').hasClass('filled');

    if (isFilled) {
      $(this).find('i').removeClass('filled');
      $(this).removeClass('filled');

      var mediaId = $(this).data('media-id');
      var userId = $(this).data('user-id');

      console.log('Media ID:', mediaId);
      console.log('User ID:', userId);
      removeFromStar(mediaId, userId);
    } else {
      $(this).addClass('filled');
      $(this).find('i').addClass('filled');
      console.log('Star button is now filled');

      var mediaId = $(this).data('media-id');
      var userId = $(this).data('user-id');

      console.log('Media ID:', mediaId);
      console.log('User ID:', userId);
      addToStar(mediaId, userId); // Call function to add to star
    }
  });

  $('.eye-button').on('click', function () {
    var isFilled = $(this).find('i').hasClass('filled');

    if (isFilled) {
      $(this).find('i').removeClass('filled');
      $(this).removeClass('filled');

      var mediaId = $(this).data('media-id');
      var userId = $(this).data('user-id');

      console.log('Media ID:', mediaId);
      console.log('User ID:', userId);
      removeFromEye(mediaId, userId);
    } else {
      $(this).addClass('filled');
      $(this).find('i').addClass('filled');
      console.log('Eye button is now filled');

      var mediaId = $(this).data('media-id');
      var userId = $(this).data('user-id');

      console.log('Media ID:', mediaId);
      console.log('User ID:', userId);
      addToEye(mediaId, userId); // Call function to add to star
    }
  });

  // Function to add to star using AJAX
  function addToStar(mediaId, userId) {
    $.ajax({
      type: 'POST',
      url: '/Project/change_classification.php', // PHP file handling the star action
      data: {
        media_id: mediaId,
        user_id: userId,
        action: 'add_to_star'
      },
      success: function (response) {
        console.log('Added to star successfully.');
        // Handle success response (if needed)
      },
      error: function (xhr, status, error) {
        console.error('Error adding to star:', error);
        // Handle error (if needed)
      }
    });
  }

  function removeFromEye(mediaId, userId) {
    $.ajax({
      type: 'POST',
      url: '/Project/change_classification.php', // PHP file handling the star action
      data: {
        media_id: mediaId,
        user_id: userId,
        action: 'remove_from_eye'
      },
      success: function (response) {
        console.log('Removed from eye successfully.');
        // Handle success response (if needed)
      },
      error: function (xhr, status, error) {
        console.error('Error adding to star:', error);
        // Handle error (if needed)
      }
    });
  }

  function addToEye(mediaId, userId) {
    $.ajax({
      type: 'POST',
      url: '/Project/change_classification.php', // PHP file handling the star action
      data: {
        media_id: mediaId,
        user_id: userId,
        action: 'add_to_eye'
      },
      success: function (response) {
        console.log('Added to eye successfully.');
        // Handle success response (if needed)
      },
      error: function (xhr, status, error) {
        console.error('Error adding to star:', error);
        // Handle error (if needed)
      }
    });
  }

  function removeFromStar(mediaId, userId) {
    $.ajax({
      type: 'POST',
      url: '/Project/change_classification.php', // PHP file handling the star action
      data: {
        media_id: mediaId,
        user_id: userId,
        action: 'remove_from_star'
      },
      success: function (response) {
        console.log('Removed from star successfully.');
        // Handle success response (if needed)
      },
      error: function (xhr, status, error) {
        console.error('Error adding to star:', error);
        // Handle error (if needed)
      }
    });
  }
});
