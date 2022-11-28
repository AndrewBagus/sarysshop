let kurir = {
  id: 0,
  nama: null,
  biaya: 0,
}
let diskons = []
let additionals = []

function refreshGrandTotal() {
  const varians = tableOrderList.rows().data().toArray()
  const subTotal = countSubTotalBerat(varians)
  let grandTotal = parseInt(subTotal)

  grandTotal += parseInt(kurir.biaya)

  $('#grand-total').html(thousandFormat(grandTotal))
}
