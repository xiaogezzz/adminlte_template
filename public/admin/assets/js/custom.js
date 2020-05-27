function ajaxSubmitData(formId) {
    var options = {
        // post-submit callback
        success: (res) => {
            console.log(res);

            if (res.code === 0 && res.status) {
                $('[data-dismiss]').click();
                Toast.fire({
                    icon: 'success',
                    title: res.msg
                });
                if (res.to) {
                    window.location.href = res.to;
                }
                if (res.jump) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            } else {
                Toast.fire({
                    icon: 'error',
                    title: res.msg ?? '操作失败，出现了未知错误，请稍后再试！'
                });
            }
        },
        error: (res) => {
            console.log(res);
            let data = res.responseJSON;
            let title = data.message ?? '操作失败，出现了未知错误，请稍后再试！'
            Toast.fire({
                icon: 'error',
                title: title
            });
        },
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
