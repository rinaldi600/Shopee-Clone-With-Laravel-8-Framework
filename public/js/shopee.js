const arrowLeft = document.querySelector('.arrow-left');
const arrowRight = document.querySelector('.arrow-right');
const bannerPromotion = document.querySelector('.banner-image');
const imageCover = [];

try {
    window.addEventListener('load', () => {
        const hostName = new URL(window.location.href).pathname;
        if (hostName === '/') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  "/banner_image",
                type: "POST",
                dataType: "JSON",
                cache: false,
                data: {
                    "data" : 'Banner Image',
                },
                success: function(output){
                    for (let key in output.image) {
                        imageCover.push(output.image[key]);
                    }
                    bannerPromotion.src = `/banner/slide_show/${output.image['2']}`
                },
                error : function(e) {
                    console.log(e);
                },
            });
        }
    });

    let number = 0;

    arrowLeft.addEventListener('click', () => {
        if (number === number && number >= imageCover.length) {
            number -= 2;
        }
        bannerPromotion.src = `/banner/slide_show/${imageCover[number < 0 ? number = imageCover.length - 1 : number]}`;
        console.log(number);
        number--
    });

    arrowRight.addEventListener('click', () => {
        if (number === -1) {
            number = 1;
        }
        bannerPromotion.src = `/banner/slide_show/${imageCover[number >= imageCover.length ? number = 0 : number]}`;
        console.log(number);
        number++;
    });
} catch (e) {

}

try {
    const productCart = document.querySelector('.product-cart');
    const detailProduct = document.querySelector('.container-detail');
    const quantityOrder = document.querySelector('.quantity-order');
    const alertInput = document.querySelector('.alert-quantity');
    productCart.addEventListener('click', (e) => {
        if (quantityOrder.value === '' || quantityOrder.value <= 0 || quantityOrder.value === 'e' || quantityOrder.value > parseInt(quantityOrder.parentElement.children[3].textContent.split(' ')[1])) {
            return alertInput.classList.remove('d-none')
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart-product",
            method: "POST",
            dataType: 'JSON',
            data:{
                idProduct: e.target.parentElement.children[1].value,
                idBuyer: e.target.parentElement.children[2].value,
                idSeller: e.target.parentElement.children[3].value,
                statusOrder: 'pending',
                quantity: quantityOrder.value
            },
            success:function(response){
                const alertSuccess = `
                     <div class='col-10 col-lg-5 success-add-product d-grid justify-content-center align-items-center'>
                        <img class='mx-auto' src='/icons/check.png' alt=''>
                        <p class='text-white'>Produk Berhasil Ditambahkan</p>
                    </div>
                `;
                detailProduct.insertAdjacentHTML('afterbegin', alertSuccess);
                setTimeout(() => {
                    return detailProduct.removeChild(detailProduct.children[0]);
                }, 1500);
                console.log(response)
            },
            error: function(error) {
                if (error) {
                    window.location.href = "/login_user";
                }
            }
        });
    })
} catch (e) {

}

try {
    const inputKeyword = document.querySelector('.keyword');
    inputKeyword.addEventListener('click', (e) => {
        e.target.parentElement.parentElement.children[1].style.zIndex = '9999';
    })
} catch (e) {

}

try {
    const buttonBuyProduct = document.querySelectorAll('.buy-product');
    const removeTransaction = document.querySelector('.remove-transaction');
    function showLoadingButton(element) {
        return element.classList.remove('d-none') && removeTransaction.classList.remove('d-none');
    }

    function removeLoadingButton(element) {
        return element.classList.add('d-none') && removeTransaction.classList.add('d-none')
    }

    for (const btn of buttonBuyProduct) {
        btn.addEventListener('click', (e) => {
            showLoadingButton(e.target.parentElement.parentElement.children[0]);
            const quantityProduct = e.target.parentElement.parentElement.children[4].firstElementChild.value;
            const idOrder = e.target.parentElement.children[0].value;
            const maxValue = e.target.parentElement.parentElement.children[4].children[0].getAttribute('max');
            const currentValue = e.target.parentElement.parentElement.children[4].children[0].value;
            if (parseInt(currentValue) > parseInt(maxValue)) {
                e.target.parentElement.parentElement.children[4].children[0].style.border = '2px solid red';
                e.target.parentElement.parentElement.children[4].children[1].classList.remove('d-none');
            } else {
                if (!e.target.parentElement.parentElement.children[4].children[1].classList.contains('d-none')) {
                    e.target.parentElement.parentElement.children[4].children[1].classList.add('d-none');
                    e.target.parentElement.parentElement.children[4].children[0].style.border = '1px solid black';
                    return false;
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/buy_product",
                        method: "POST",
                        dataType: 'JSON',
                        data:{
                            quantityProduct: quantityProduct,
                            idOrder : idOrder
                        },
                        success:function(response){
                            if (JSON.stringify(response) !== '{}') {
                                setTimeout(() => {
                                    removeLoadingButton(e.target.parentElement.parentElement.children[0]);
                                    window.location.href = `/payment/${response.idOrder}`;
                                }, 1500);
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    });
                }
            }
        })
    }
} catch (e) {

}

try {
    const buttonPayment = document.querySelectorAll('.btn-payment');
    const listPayment = document.querySelector('.list-payment');
    for (const [index, btn] of buttonPayment.entries()) {
        btn.addEventListener('click', (e) => {
            if (e.target.textContent === 'Transfer Bank') {
                e.target.classList.add('active-border');
                if (e.target.classList.contains('active-border')) {
                    e.target.style.border = '2px solid rgb(254,87,34)';
                    e.target.style.color = 'rgb(254,87,34)';
                }

                const getElement = [...buttonPayment].filter((x) => x !== btn);
                getElement.forEach((value,index) => {
                    if (value.classList.contains('active-border')) {
                        value.classList.remove('active-border');
                        value.style.border = '2px solid rgb(220,220,220)';
                        value.style.color = 'rgb(0,0,0)';
                    }
                });

                for (const payment of listPayment.children) {
                    if (payment.classList.contains('transfer-bank')) {
                        payment.classList.remove('d-none');
                    } else {
                        if (!payment.classList.contains('d-none')) {
                            payment.classList.add('d-none')
                        }
                    }
                }
            }

            if (e.target.textContent === 'Outlet') {
                e.target.classList.add('active-border');
                if (e.target.classList.contains('active-border')) {
                    e.target.style.border = '2px solid rgb(254,87,34)';
                    e.target.style.color = 'rgb(254,87,34)';
                }

                const getElement = [...buttonPayment].filter((x) => x !== btn);
                getElement.forEach((value,index) => {
                    if (value.classList.contains('active-border')) {
                        value.classList.remove('active-border');
                        value.style.border = '2px solid rgb(220,220,220)';
                        value.style.color = 'rgb(0,0,0)';
                    }
                });

                for (const payment of listPayment.children) {
                    if (payment.classList.contains('outlet')) {
                        payment.classList.remove('d-none');
                    } else {
                        if (!payment.classList.contains('d-none')) {
                            payment.classList.add('d-none')
                        }
                    }
                }
            }

            if (e.target.textContent === 'E-Wallet') {
                e.target.classList.add('active-border');
                if (e.target.classList.contains('active-border')) {
                    e.target.style.border = '2px solid rgb(254,87,34)';
                    e.target.style.color = 'rgb(254,87,34)';
                }

                const getElement = [...buttonPayment].filter((x) => x !== btn);
                getElement.forEach((value,index) => {
                    if (value.classList.contains('active-border')) {
                        value.classList.remove('active-border');
                        value.style.border = '2px solid rgb(220,220,220)';
                        value.style.color = 'rgb(0,0,0)';
                    }
                });

                for (const payment of listPayment.children) {
                    if (payment.classList.contains('e-wallet')) {
                        payment.classList.remove('d-none');
                    } else {
                        if (!payment.classList.contains('d-none')) {
                            payment.classList.add('d-none')
                        }
                    }
                }
            }

            if (e.target.textContent === 'Transfer Manual') {
                e.target.classList.add('active-border');
                if (e.target.classList.contains('active-border')) {
                    e.target.style.border = '2px solid rgb(254,87,34)';
                    e.target.style.color = 'rgb(254,87,34)';
                }

                const getElement = [...buttonPayment].filter((x) => x !== btn);
                getElement.forEach((value,index) => {
                    if (value.classList.contains('active-border')) {
                        value.classList.remove('active-border');
                        value.style.border = '2px solid rgb(220,220,220)';
                        value.style.color = 'rgb(0,0,0)';
                    }
                });

                for (const payment of listPayment.children) {
                    if (payment.classList.contains('transfer-manual')) {
                        payment.classList.remove('d-none');
                    } else {
                        if (!payment.classList.contains('d-none')) {
                            payment.classList.add('d-none')
                        }
                    }
                }
            }
            console.log(e.target.textContent);
        })
    }
} catch (e) {

}

try {

    const btnUploadImageProof = document.querySelector('.image-proof');
    const imagePreview = document.querySelector('.image-proof-preview');
    const zoomButton = document.querySelector('.zoom');
    const btnNotificationPayment = document.querySelector('.close-notifications');
    const notificationPayment = document.querySelector('.notifications-payment');

    let urlImage = '';
    btnUploadImageProof.addEventListener('change', (e) => {
        const [file] = e.target.files;
        const typeFile = file.type.split('/')[0];
        if (typeFile === 'image') {
            console.log(typeFile);
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                urlImage = imagePreview.src;
                !e.target.parentElement.parentElement.children[4].classList.contains('d-none') ?
                    e.target.parentElement.parentElement.children[4].classList.add('d-none') : '';
                e.target.parentElement.parentElement.children[5].classList.remove('pe-none');
                zoomButton.classList.remove('d-none');
            }
        } else {
            imagePreview.src = '/img/icons8-error.gif';
            !zoomButton.classList.contains('d-none') ? zoomButton.classList.add('d-none') : '';
            !e.target.parentElement.parentElement.children[5].classList.contains('pe-none') ?
                e.target.parentElement.parentElement.children[5].classList.add('pe-none') : '';
            e.target.parentElement.parentElement.children[4].classList.remove('d-none');
        }
    });
    zoomButton.addEventListener('click', (e) => {
       window.open(urlImage, '_blank');
    });

    btnNotificationPayment.addEventListener('click', (e) => {
        notificationPayment.classList.add('d-none');
        window.location = '/carts'
    })

} catch (e) {

}

try {
    const btnChangePayment = document.querySelectorAll('.btn-change-proof');
    const btnCancelPayment = document.querySelectorAll('.btn-cancel-proof');

    for (const x of btnChangePayment) {
        x.addEventListener('click', (e) => {
            e.target.parentElement.parentElement.children[2].classList.remove('d-none');
        })
    }

    for (const y of btnCancelPayment) {
        y.addEventListener('click', (e) => {
            e.target.parentElement.parentElement.parentElement.classList.add('d-none');
        })
    }
} catch (e) {

}
