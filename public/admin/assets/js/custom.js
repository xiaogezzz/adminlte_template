function ajaxSubmitData(formId) {
    var options = {
        success: showResponse,  // post-submit callback,
        error: showError,
    };

    // bind form using 'ajaxForm'
    $('#' + formId).ajaxForm(options);
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});

/**
 * 提交成功回调
 * @param res
 */
function showResponse(res) {
    console.log(res);

    if (res.code === 0 && res.status) {
        $('[data-dismiss]').click();

        Toast.fire({
            icon: 'success',
            title: res.msg
        });

        if (res.jump) {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    } else {
        Toast.fire({
            icon: 'error',
            title: res.msg ?? '操作失败，出现了未知错误，请稍后再试！'
        });
    }
}


/**
 * 提交失败回调
 */
function showError(res) {
    let data = res.responseJSON;
    console.log(data);
    let title = data.message ?? '操作失败，出现了未知错误，请稍后再试！'
    Toast.fire({
        icon: 'error',
        title: title
    });
}
