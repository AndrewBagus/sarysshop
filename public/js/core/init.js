$(function (w, d) {
  $('.select2bs4').select2({
    theme: 'bootstrap5',
    allowClear: true,
  })

  $('.select2bs4-nonclear').select2({
    theme: 'bootstrap5',
  })

  $(document).on('blur', 'input[data-toggle=datetimepicker]', function () {
    $(this).data('datetimepicker').hide()
  })

  $('input[data-toggle=datetimepicker]').datetimepicker({
    format: date_format,
  })

  // !(function (Z, _, ba, bb) {
  //   Z.zarazData = Z.zarazData || {}
  //   Z.zarazData.executed = []
  //   Z.zaraz = {
  //     deferred: [],
  //     listeners: [],
  //   }
  //   Z.zaraz.q = []
  //   Z.zaraz._f = function (bc) {
  //     return function () {
  //       var bd = Array.prototype.slice.call(arguments)
  //       Z.zaraz.q.push({
  //         m: bc,
  //         a: bd,
  //       })
  //     }
  //   }
  //   for (const be of ['track', 'set', 'debug']) Z.zaraz[be] = Z.zaraz._f(be)
  //   Z.zaraz.init = () => {
  //     var bf = _.getElementsByTagName(bb)[0],
  //       bg = _.createElement(bb),
  //       bh = _.getElementsByTagName('title')[0]
  //     bh && (Z.zarazData.t = _.getElementsByTagName('title')[0].text)
  //     Z.zarazData.x = Math.random()
  //     Z.zarazData.w = Z.screen.width
  //     Z.zarazData.h = Z.screen.height
  //     Z.zarazData.j = Z.innerHeight
  //     Z.zarazData.e = Z.innerWidth
  //     Z.zarazData.l = Z.location.href
  //     Z.zarazData.r = _.referrer
  //     Z.zarazData.k = Z.screen.colorDepth
  //     Z.zarazData.n = _.characterSet
  //     Z.zarazData.o = new Date().getTimezoneOffset()
  //     Z.zarazData.q = []
  //     for (; Z.zaraz.q.length; ) {
  //       const bl = Z.zaraz.q.shift()
  //       Z.zarazData.q.push(bl)
  //     }
  //     bg.defer = !0
  //     for (const bm of [localStorage, sessionStorage])
  //       Object.keys(bm || {})
  //         .filter((bo) => bo.startsWith('_zaraz_'))
  //         .forEach((bn) => {
  //           try {
  //             Z.zarazData['z_' + bn.slice(7)] = JSON.parse(bm.getItem(bn))
  //           } catch {
  //             Z.zarazData['z_' + bn.slice(7)] = bm.getItem(bn)
  //           }
  //         })
  //     bg.referrerPolicy = 'origin'
  //     bg.src =
  //       '/cdn-cgi/zaraz/s.js?z=' +
  //       btoa(encodeURIComponent(JSON.stringify(Z.zarazData)))
  //     bf.parentNode.insertBefore(bg, bf)
  //   }
  //   ;['complete', 'interactive'].includes(_.readyState)
  //     ? zaraz.init()
  //     : Z.addEventListener('DOMContentLoaded', zaraz.init)
  // })(w, d, 0, 'script')

  window.addEventListener('load', function () {
    const t = document.getElementById('loader')
    setTimeout(function () {
      t.classList.add('fadeOut')
    }, 300)
  })
})
