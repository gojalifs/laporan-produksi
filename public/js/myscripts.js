const flashData = $('#flash-data').data('flashdata');
console.log('flash-data',flashData);

if(flashData !== null){
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      })
}
$("#toastr-2").click(function () {
    // iziToast.success({
    //   title: 'Hello, world!',
    //   message: 'This awesome plugin is made by iziToast',
    //   position: 'topRight'
    // });
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      })
  });