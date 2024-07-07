@extends('admin.layout.main')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-6">
                <div>
                    <input id="search" class="form-control" type="text" placeholder="Search ">
                    <div id="resultSearch" class="resultSearch border rounded overflow-y-scroll"
                        style="height: 300px; display: none ">
                        <div class="list-group">
                            <table class="table hover">
                                <tbody id="searchResults">
                                    <!-- Search results will be appended here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="listItem mt-4 overflow-x-scroll">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">avatar</th>
                                <th scope="col">name</th>
                                <th scope="col">giá</th>
                                <th scope="col">color</th>
                                <th scope="col">size</th>
                                <th scope="col">số lượng</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="productList" class="">
                            <!-- Product items will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6 rounded shadow">
                <div class="bill">
                    <p class="text-end resetBill"><i class="bi bi-arrow-clockwise h4"></i></p>

                    <div class="row pt-4">
                        <div class="col-7 avatar">
                            <img src="http://127.0.0.1:8000/storage/theme_admin/upload/photo/pGXYoynx3DNuMVglYQFcTMdSXMn6bXIPxsrjHGaF.png"
                                alt="" class="h-100 w-100">
                        </div>
                        <div class="col-5 shopInfor">
                            <p>Phone: +1 0000000000</p>
                            <p>Address: NIT, Faridabad, Haryana, India</p>
                            <p>Email: Contact@Surfsidemedia.In</p>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <h3>Hóa đơn bán hàng</h3>
                    </div>
                    <div class="d-flex">
                        <div class="form-floating mb-3 flex-fill">
                            <input type="text" class="form-control" id="customerName">
                            <label for="customerName">Khách hàng</label>
                        </div>
                        <div class="form-floating mb-3 flex-fill">
                            <input type="number" class="form-control" id="customerPhone">
                            <label for="customerPhone">Số điện thoại</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="customerAddress">
                        <label for="customerAddress">Địa chỉ</label>
                    </div>
                    <div class="pt-4 billItem">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="billItem">
                                <!-- Bill items will be appended here -->
                            </tbody>
                        </table>
                    </div>
                    <h3 class="amount mt-4">Tổng tiền: <span id="totalAmount">0đ</span></h3>
                    <input type="hidden" value="" id="totalAmountInput" name="">
                    <p class="text-end" id="current-date"></p>

                    <div class="d-flex flex-row-reverse">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="creator" value="{{ Auth::user()->name }}">
                            <label for="creator">Người lập</label>
                        </div>
                    </div>
                    <div class="py-4 text-center">
                        <button type="button" class="btn btn-outline-primary" id="createInvoiceBtn">Tạo hóa đơn</button>
                        {{-- <button type="button" class="btn btn-outline-primary"onclick="confirmCreate(event)">Tạo hóa
                            đơn</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const resultSearch = document.getElementById('resultSearch');
            const searchResults = document.getElementById('searchResults');
            const productList = document.getElementById('productList');
            const billItem = document.getElementById('billItem');
            const resetBillBtn = document.querySelector('.resetBill');
            const totalAmountSpan = document.getElementById('totalAmount');
            const totalAmountInput = document.getElementById('totalAmountInput');

            // Function to search products
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.trim();
                if (query.length > 0) {
                    fetch(`cashier/search-product?q=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            searchResults.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach(product => {
                                    const tr = document.createElement('tr');
                                    const imageUrl = `/storage/${product.avatar}`;
                                    tr.innerHTML = `
                                        <td role="button"><img src="${imageUrl}" alt="${product.name}" width="30px" height="30px"></td>
                                        <td role="button">${product.name}</td>
                                        <td role="button">${product.price}</td>
                                    `;
                                    tr.addEventListener('click', function() {
                                        addProductToList(product);
                                        searchResults.innerHTML = '';
                                        resultSearch.style.display = 'none';
                                        searchInput.value = '';
                                    });
                                    searchResults.appendChild(tr);
                                });
                                resultSearch.style.display = ''; // Show resultSearch div
                            } else {
                                resultSearch.style.display = 'none'; // Hide resultSearch div
                            }
                        });
                } else {
                    searchResults.innerHTML = '';
                    resultSearch.style.display = 'none'; // Hide resultSearch div
                }
            });

            // Function to add product to the list
            function addProductToList(product) {
                fetch(`cashier/product-details/${product.id}`)
                    .then(response => response.json())
                    .then(details => {
                        const tr = document.createElement('tr');
                        const imageUrl = `/storage/${product.avatar}`;
                        tr.innerHTML = `
                    <th scope="row">${productList.children.length + 1}</th>
                    <td><img src="${imageUrl}" alt="${product.name}" width="50"></td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td>
                        <select class="color-select">
                            ${details.map(detail => `<option value="${detail.color}">${detail.color}</option>`).join('')}
                        </select>
                    </td>
                    <td>
                        <select class="size-select">
                            <!-- Sizes will be populated based on selected color -->
                        </select>
                    </td>
                    <td> <input class="quantity" type="text" placeholder="" size="4"></td>
                    <td><button type="button" class="btn btn-outline-success add-bill-btn">Add bill</button></td>
                `;

                        const colorSelect = tr.querySelector('.color-select');
                        const sizeSelect = tr.querySelector('.size-select');
                        const addBillBtn = tr.querySelector('.add-bill-btn');
                        const quantityInput = tr.querySelector('.quantity');

                        colorSelect.addEventListener('change', function() {
                            const selectedColor = colorSelect.value;
                            sizeSelect.innerHTML = details
                                .filter(detail => detail.color === selectedColor)
                                .map(detail => `<option value="${detail.size}">${detail.size}</option>`)
                                .join('');
                        });

                        addBillBtn.addEventListener('click', function() {
                            addProductToBill(product, colorSelect.value, sizeSelect.value, quantityInput
                                .value);
                        });

                        productList.appendChild(tr);
                    });
            }

            // Function to add product to the bill
            function addProductToBill(product, color, size, quantity) {
                const total = product.price * quantity;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <th scope="row">${billItem.children.length + 1}</th>
                    <td>${product.name} (${color}, ${size})</td>
                    <td>${quantity}</td>
                    <td>${product.price}</td>
                    <td>${total}</td>
                `;
                billItem.appendChild(tr);
                updateTotalAmount();
            }

            // Function to update total amount
            function updateTotalAmount() {
                let totalAmount = 0;
                billItem.querySelectorAll('tr').forEach(row => {
                    const amount = parseFloat(row.children[4].innerText);
                    totalAmount += amount;
                });
                totalAmountSpan.innerText = totalAmount;
                totalAmountInput.value = totalAmount;
            }

            // Function to reset the bill
            resetBillBtn.addEventListener('click', function() {
                billItem.innerHTML = '';
                updateTotalAmount();
            });
        });
    </script>

    <script>
        function formatCurrentDate() {
            const today = new Date();
            const day = today.getDate();
            const monthNames = ["tháng 1", "tháng 2", "tháng 3", "tháng 4", "tháng 5", "tháng 6", "tháng 7", "tháng 8",
                "tháng 9", "tháng 10", "tháng 11", "tháng 12"
            ];
            const month = monthNames[today.getMonth()];
            const year = today.getFullYear();

            return `${day} / ${month} / ${year}`;
        }

        document.getElementById('current-date').textContent = formatCurrentDate();
    </script>

<script>
    // async function confirmCreate(event) {
    //     event.preventDefault();

    //     const swalWithBootstrapButtons = Swal.mixin({
    //         customClass: {
    //             confirmButton: "btn btn-success ms-4",
    //             cancelButton: "btn btn-danger"
    //         },
    //         buttonsStyling: false
    //     });

    //     try {
    //         const result = await swalWithBootstrapButtons.fire({
    //             title: "Xác nhận tạo đơn hàng và in hóa đơn?",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Yes, do it!",
    //             cancelButtonText: "No, cancel!",
    //             reverseButtons: true
    //         });

    //         if (result.isConfirmed) {
    //             await new Promise(resolve => {
    //                 document.getElementById('createInvoiceBtn').addEventListener('click', resolve, { once: true });
    //                 document.getElementById('createInvoiceBtn').click();
    //             });
    //         } else if (result.dismiss === Swal.DismissReason.cancel) {
    //             swalWithBootstrapButtons.fire({
    //                 title: "Cancelled",
    //                 text: "Your imaginary file is safe :)",
    //                 icon: "error"
    //             });
    //         }
    //     } catch (error) {
    //         console.error('Error handling confirmation:', error);
    //     }

    //     $('.swal2-confirm.btn-success.ms-4').attr('id', 'createInvoiceBtn');
    // }

    document.addEventListener('DOMContentLoaded', function() {
        const createInvoiceBtn = document.getElementById('createInvoiceBtn');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        createInvoiceBtn.addEventListener('click', async function() {
            const customerName = document.getElementById('customerName').value;
            const customerPhone = document.getElementById('customerPhone').value;
            const customerAddress = document.getElementById('customerAddress').value;
            const creator = document.getElementById('creator').value;
            const currentDate = new Date().toLocaleDateString('en-US');

            const billItems = [];
            document.querySelectorAll('#billItem tr').forEach(
                row => { // Lấy thông tin từ các hàng trong #billItem
                    const productName = row.cells[1].innerText;
                    const quantity = row.cells[2].innerText;
                    const unitPrice = row.cells[3].innerText;
                    const totalPrice = row.cells[4].innerText;
                    billItems.push({
                        productName,
                        quantity,
                        unitPrice,
                        totalPrice
                    });
                }
            );

            const data = {
                customerName,
                customerPhone,
                customerAddress,
                creator,
                currentDate,
                billItems
            };

            try {
                const createOrderResponse = await fetch('/admin/cashier/createOrder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        data
                    })
                });

                if (!createOrderResponse.ok) {
                    throw new Error('Failed to create order');
                }

                const printInvoiceResponse = await fetch('cashier/print-invoice', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        'invoiceData': data
                    })
                });

                if (!printInvoiceResponse.ok) {
                    throw new Error('Failed to print invoice');
                }

                const html = await printInvoiceResponse.text();
                const printWindow = window.open('', 'PRINT', 'height=600,width=800');
                printWindow.document.write(html);
                printWindow.document.close();
                printWindow.focus();

                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 1000);
            } catch (error) {
                console.error('Error processing invoice:', error);
                // Xử lý khi có lỗi xảy ra
            }
        });
    });
</script>


@endsection
