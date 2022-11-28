<div class="col-md-12 mb-3">
  <div class="card">
    <div class="card-header">
      <h3>Order</h3>
    </div>
    <div class="card-body">
      <table id="table-detail-order-list" class="" width="100%">
        <thead>
          <tr>
            <td>Nama</td>
            <td>Harga</td>
            <td>QTY</td>
            <td>Subtotal</td>
          </tr>
        </thead>
        <tbody></tbody>
        <tbody id="sub-total-wrapper">
          <tr>
            <td colspan="3" style="font-weight: 400; font-size: 16px;">Subtotal</td>
            <td style="font-weight: bold;">Rp. <span id="sub-total">0</span></td>
          </tr>
          <tr>
            <td colspan="3">
              <span style="font-weight: 400; font-size: 16px; display: inline;">Ongkas Kirim <span id="berat-total" style="font-weight: bold;"></span> - <span id="kurir-nama" style="font-weight: bold;"></span></span>
              <button class="btn btn-outline-primary btn-sm" id="btn-biaya-kurir" data-bs-toggle="tooltip" data-bs-title="Ubah Kurir"><i class="fa fa-edit"></i></button>
            </td>
            <td style="font-weight: bold;">Rp. <span id="ongkir">0</span></td>
          </tr>
        </tbody>
        <tbody id="diskon-wrapper">
        </tbody>
        <tbody id="additional-wrapper">
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">
              <div id="btn-wrapper-additionl" class="ps-0 my-2" style="display: flex; gap: 5px; flex-wrap: wrap;">
                  <button class="btn btn-outline-success btn-sm" id="btn-global-diskon" data-bs-toggle="tooltip" data-bs-title="Diskon"><i class="fa fa-plus"></i> Diskon</button>
                  <button class="btn btn-outline-success btn-sm" id="btn-global-additional" data-bs-toggle="tooltip" data-bs-title="Biaya Lain"><i class="fa fa-plus"></i> Biaya Lain</button>
                  <!-- <button class="btn btn-outline-success btn-sm" id="btn-gobal-insurance" data-bs-toggle="tooltip" data-bs-title="Asuransi"><i class="fa fa-plus"></i> Asuransi</button> -->
              </div>
            </td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3" style="font-size: 23px; font-weight: bold">Total</td>
            <td style="font-size: 23px; font-weight: bold">Rp. <span id="grand-total">0</span></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
