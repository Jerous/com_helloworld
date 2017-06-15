//verify that all forms which have the "form-validate" css class are valid.

Joomla.submitbutton = function (task) {
  if (task == '') {
    return false;
  } else {
    var isValid = true;
    var action = task.split('.');
    if (action[1] != 'cancel' && action[1] != 'close') {
      var forms = jQuery('form.form-validate');
      for (var i = 0; i < forms.length; i++) {
        if (!document.formvalidator.isValid(forms[i])) {
          isValid = false;
          break;
        }
      }
    }

    if (isValid) {
      Joomla.submitform(task);
      return true;
    } else {
      // Note that it will display an alert message translated by the Joomla framework.
      alert(Joomla.JText._('COM_HELLOWORLD_HELLOWORLD_ERROR_UNACCEPTABLE',
        'Some values are unacceptable'));
      return false;
    }
  }
}