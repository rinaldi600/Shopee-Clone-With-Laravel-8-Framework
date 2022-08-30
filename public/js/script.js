try {
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: '',
            backgroundColor: 'rgb(252,89,49)',
            borderColor: 'rgb(252,89,49)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins : {
                legend : {
                    display : false,
                    color : 'rgb(252,89,49)',
                },
            },
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
} catch (e) {

}


try {
    const previewImageButton = document.querySelector('.preview-image');
    const previewImage = document.querySelector('.preview img');
    const alertImage = document.querySelector('.alert-format');

    previewImageButton.addEventListener('change', (e) => {
        if (previewImageButton.files.length === 0 ){
            previewImage.src = '/img/cloud-computing.png';
            return false;
        }

        const [file] = previewImageButton.files;
        const typeFile = file.type.split('/')[0];

        if (typeFile === "image") {
            previewImage.src = URL.createObjectURL(file);
            if (!alertImage.classList.contains('d-none')) {
                alertImage.classList.add('d-none');
            }
        } else {
            previewImage.src = '/img/warning.png';
            alertImage.classList.remove('d-none');
        }

    });

} catch (e) {

}

try {
    const priceInput = document.querySelector('.price-input');
    priceInput.addEventListener('input', () => {
        if (isNaN(parseInt(priceInput.value))) {
            priceInput.value = '';
        } else {
            let valuePrice = priceInput.value.replace(/[\D\s\._\-]+/g, "");
            priceInput.value = parseInt(valuePrice).toLocaleString('id-ID');
        }
    })
} catch (e) {

}

try {
    const searchKeyword = document.querySelector('.search-keyword');
    const searchFilter = document.querySelector('.search-filter');
    const searchData = document.querySelector('.search-data');
    const alertInput = document.querySelector('.alert-input');
    searchFilter.addEventListener('change', () => {
        const value = searchFilter.value;
        const valueKeyword = searchKeyword.value;
        if (value === 'Pilih Filter') {
            searchData.parentElement.children[1].classList.add('block');
            searchData.classList.add('block-two');
            if (!alertInput.classList.contains('d-none')) {
                alertInput.classList.add('d-none')
            }
        } else if (value === 'all') {
            searchData.parentElement.children[1].classList.remove('block');
            searchData.classList.remove('block-two');
            if (!alertInput.classList.contains('d-none')) {
                alertInput.classList.add('d-none')
            }
        } else if (value === 'nama') {
            searchData.parentElement.children[1].classList.remove('block');
            searchData.classList.remove('block-two');
            if (!alertInput.classList.contains('d-none')) {
                alertInput.classList.add('d-none')
            }
        } else if (value === 'jumlah') {
            if(isNaN(Number(valueKeyword))) {
                searchData.parentElement.children[1].classList.add('block');
                searchData.classList.add('block-two');
                alertInput.classList.remove('d-none')
            } else {
                searchData.parentElement.children[1].classList.remove('block');
                searchData.classList.remove('block-two');
                alertInput.classList.add('d-none')
            }
        } else {
            if(isNaN(Number(valueKeyword))) {
                searchData.parentElement.children[1].classList.add('block');
                searchData.classList.add('block-two');
                alertInput.classList.remove('d-none')
            } else {
                searchData.parentElement.children[1].classList.remove('block');
                searchData.classList.remove('block-two');
                alertInput.classList.add('d-none')
            }
        }
    });
    searchKeyword.addEventListener('input', () => {
       const value = searchFilter.value;
       if (value === 'jumlah' || value === 'harga') {
           if (isNaN(Number(searchKeyword.value))) {
               searchData.parentElement.children[1].classList.add('block');
               searchData.classList.add('block-two');
               alertInput.classList.remove('d-none')
           } else {
               searchData.parentElement.children[1].classList.remove('block');
               searchData.classList.remove('block-two');
               alertInput.classList.add('d-none')
           }
       }
    })
} catch (e) {

}

try {
    const btnViewImageProofPayment = document.querySelectorAll('.view-proof-payment');
    const notes = document.querySelectorAll('.notes');
    const inputNotes = document.querySelectorAll('.change-notes');
    const notesContainer = document.querySelectorAll('.notes-container');
    const loading = document.querySelector('.loading-update-note');
    const statusOther = document.querySelectorAll('.status-order-other');
    const searchData = document.querySelector('.filter-search-data');

    searchData.addEventListener('change', (e) => {
        const elementArray = [].slice.call(e.target.parentElement.children).slice(0,3);

        if (e.target.value === 'filter') {
            const currentURL = window.location.href;

            elementArray.filter((x) => {
                return x.classList.add('d-none')
            });

            if (currentURL.includes('?')) {
                window.location.href = '/dashboard_seller/order_product'
            }
        }

        if (e.target.value === 'status-order') {
            e.target.parentElement.children[2].classList.remove('d-none');
            elementArray.filter((x) => {
                if (x !== e.target.parentElement.children[2]) {
                    return x.classList.add('d-none')
                }
            })
        }

        if (e.target.value === 'tanggal-pemesanan') {
            e.target.parentElement.children[1].classList.remove('d-none');
            elementArray.filter((x) => {
                if (x !== e.target.parentElement.children[1]) {
                    return x.classList.add('d-none')
                }
            })
        }

        if (e.target.value === 'nama-produk') {
            e.target.parentElement.children[0].classList.remove('d-none');
            elementArray.filter((x) => {
                if (x !== e.target.parentElement.children[0]) {
                    return x.classList.add('d-none')
                }
            })
        }
    });

    for (const status of statusOther) {
        status.addEventListener('change', (e) => {
            if (e.target.value.toLowerCase() !== 'pilih') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/confirm_order',
                    data: {
                        'idOrder' :e.target.parentElement.children[0].value,
                        'other' : 'other',
                        'value' : e.target.value,
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.hasOwnProperty('successRejected')) {
                            window.location.reload();
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        })
    }

    for (const btn of btnViewImageProofPayment) {
        btn.addEventListener('click', (e) => {
           let image = e.target.parentElement.children[0];
           window.open(image.src, '_blank');
        });
    }

    for (const note of notes) {
        note.addEventListener('click', (e) => {
            let inputNotes = e.target.parentElement.children[1];
            inputNotes.classList.remove('d-none');
            e.target.classList.add('d-none');
        })
    }

    for (const input of inputNotes) {
        input.addEventListener('focusout', (e) => {
            let textNotes = e.target.parentElement.children[0];
            let idOrder = e.target.parentElement.parentElement.children[0].children[0].value;
            textNotes.classList.remove('d-none');
            e.target.classList.add('d-none');
            if( confirm('Apakah Anda Inging Mengubah Data ?') === true ) {
                if (e.target.value === '') {
                    alert("INPUT KOSONG")
                } else {
                    const timeOne = new Date().getTime();
                    $.ajax({
                        type: 'POST',
                        url: "/change_note",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            idOrder : idOrder,
                            textNotes : e.target.value,
                        },
                        success:function(data){
                            const timeTwo = new Date().getTime();
                            loading.classList.remove('d-none');
                            setTimeout(()=> {
                                loading.classList.add('d-none');
                                console.log(data);
                            }, timeTwo - timeOne);
                            location.reload();
                        },
                        error : function (error) {
                            console.log(error)
                        }
                    });
                }
            } else {
                console.log("WELCOME")
            }
        })
    }

    for (const container of notesContainer) {
        container.addEventListener('click', (e) => {
           let inputNote = container.querySelector('.change-notes');
           let titleNote = container.querySelector('.notes');
           if ( (e.target === container) && !inputNote.classList.contains('d-none'))  {
                inputNote.classList.add('d-none');
                titleNote.classList.remove('d-none');
           }
        });
    }
} catch (e) {

}
