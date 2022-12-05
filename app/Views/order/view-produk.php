<div class="modal" id="modal-view-produk" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">View Produk Order: <span id="view-produk-title"></span></h3>
      </div>
      <div class="modal-body">
        <table id="table-view-produk-list" class="table-order" width="100%">
          <thead>
            <tr>
              <td>Nama</td>
              <td>Harga</td>
              <td>QTY</td>
              <td>Subtotal</td>
            </tr>
          </thead>
          <tbody></tbody>
          <tbody id="view-sub-total-wrapper">
            <tr>
              <td colspan="3" style="font-weight: 400; font-size: 16px;">Subtotal</td>
              <td style="font-weight: bold;">Rp. <span id="view-sub-total-display">0</span></td>
            </tr>
            <tr>
              <td colspan="3">
                <span style="font-weight: 400; font-size: 16px; display: inline;">Ongkos Kirim <span id="view-berat-total" style="font-weight: bold;"></span> - <span id="view-kurir-nama" style="font-weight: bold;"></span></span>
              </td>
              <td style="font-weight: bold;">Rp. <span id="view-ongkir">0</span></td>
            </tr>
          </tbody>
          <tbody id="view-diskon-wrapper">
          </tbody>
          <tbody id="view-additional-wrapper">
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" style="font-size: 23px; font-weight: bold">Total</td>
              <td style="font-size: 23px; font-weight: bold"><span id="view-grand-total-display">Rp. 0</span></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
