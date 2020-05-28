window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    // 删除按钮
    $('[data-href].delete').on('click', function () {
        Swal.fire({
            title: '确定删除吗?',
            text: "删除后将无法恢复!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DC3545',
            // cancelButtonColor: '#007BFF',
            confirmButtonText: '确定删除',
            cancelButtonText: '取消',
            showLoaderOnConfirm: true,
            preConfirm: action => {
                return axios({
                    method: 'DELETE',
                    url: $(this).attr('data-href'),
                })
                    .then(response => {
                        if (response.data.code !== 0) {
                            console.log(response.data)
                            throw new Error(response.data.msg)
                        }
                        return response.data
                    })
                    .catch(error => {
                        console.log(error.response.data)
                        Swal.fire(
                            '错误!',
                            error.response.data.message,
                            'error'
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(result => {
            if (result.value) {
                Swal.fire(
                    '已删除!',
                    '数据删除成功.',
                    'success'
                )
                    .then(setTimeout(() => window.location.reload(), 1000))
            }
        })
    })
});

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
                    setTimeout(() => window.location.href = res.to, 1000);
                    return;
                }
                if (res.jump) {
                    setTimeout(() => window.location.reload(), 1000);
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
