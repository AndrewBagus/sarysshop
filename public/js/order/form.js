let kurir = {
  id: 0,
  nama: null,
  biaya: 0,
}
let diskons = []
let additionals = []

function countSubTotalBerat(arrays) {
  let grandSubtotal = 0
  let berat = 0

  if (arrays.length > 0) {
    for (const item of arrays) {
      grandSubtotal += parseInt(item.subtotal)
      berat += parseInt(item.berat) * parseInt(item.qty)
    }
    berat = berat / 1000
  }

  const grandBerat = berat > 0 ? berat : ''
  $('#sub-total').html(thousandFormat(grandSubtotal))
  $('#berat-total').html(`(${grandBerat}Kg)`)

  return grandSubtotal
}

function refreshGrandTotal() {
  const varians = tableOrderList.rows().data().toArray()
  const subTotal = countSubTotalBerat(varians)
  let grandTotal = parseInt(subTotal)

  grandTotal += parseInt(kurir.biaya)

  $('#grand-total').html(thousandFormat(grandTotal))
}
