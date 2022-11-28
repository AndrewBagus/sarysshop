let subtotal = 0
let kurir = {
  id: 0,
  nama: null,
  biaya: 0,
}
let diskons = []
let additionals = []

function countSubTotalBerat(arrays) {
  subtotal = 0
  let berat = 0
  if (arrays.length > 0) {
    for (const item of arrays) {
      subtotal += parseInt(item.subtotal)
      berat += parseInt(item.berat) * parseInt(item.qty)
    }
    berat = berat / 1000
  }

  const grandBerat = berat > 0 ? berat : ''
  $('#sub-total').html(thousandFormat(subtotal))
  if (grandBerat !== '') $('#berat-total').html(`(${grandBerat}Kg)`)
  else $('#berat-total').html('')

  return subtotal
}

function refreshGrandDiskon(index, data) {
  if (index === '') {
    diskons.push(data)
  } else {
    const diskon = diskons[index]
    data.id = diskon.id
    diskons[index] = data
  }
  createDiskonAdditional('#diskon-wrapper', diskons, true)
}

function refreshGrandAdditional(index, data) {
  if (index === '') {
    additionals.push(data)
  } else {
    const additional = additionals[index]
    data.id = additional.id
    additionals[index] = data
  }
  createDiskonAdditional('#additional-wrapper', additionals, false)
}

function createDiskonAdditional(usage, arrays, is_red) {
  let contents = ''
  for (const item of arrays) {
    const nominal = thousandFormat(item.nominal)
    let nominalArea = is_red
      ? `<td style="color:#ff5f5f">Rp. (${nominal})</td>)`
      : `<td>Rp. ${nominal}</td>`
    const nama = item.nama !== '' ? ` - ${item.nama}` : ''
    const persen = item.tipe === 'percen' ? ` ${item.persen}%` : ''
    const title = is_red ? 'Diskon Order' : 'Biaya Lain'
    let content = `<tr><td colspan="3">${title}`
    if (persen !== '') content += persen
    if (nama !== '') content += nama
    content += `</td>${nominalArea}</tr>`

    contents += content
  }
  $(usage).html(contents)
}

function countDiskonAdditional(arrays) {
  let total = 0
  for (const item of arrays) {
    total += parseInt(item.nominal)
  }
  return total
}

function refreshGrandTotal() {
  const varians = tableOrderList.rows().data().toArray()
  const subTotal = countSubTotalBerat(varians)
  const grandDiskon = countDiskonAdditional(diskons)
  const grandAdditional = countDiskonAdditional(additionals)
  let grandTotal = parseInt(subTotal)

  grandTotal += parseInt(kurir.biaya)
  grandTotal -= parseInt(grandDiskon)
  grandTotal += parseInt(grandAdditional)

  $('#grand-total').html(thousandFormat(grandTotal))
}
