<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Medicine Billing Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    .select2-container--default .select2-selection--single {
      @apply border-gray-300 rounded-md p-2 h-10;
    }
    .select2-selection__rendered {
      line-height: 2.25rem !important;
    }
    .select2-selection {
      height: 2.5rem !important;
    }
    .select2-selection__arrow {
      height: 2.5rem !important;
    }
  </style>
</head>
<body class="bg-gray-100 p-6 font-sans">

  <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow space-y-6">
    <h1 class="text-2xl font-bold">Medicine Billing Form</h1>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm border border-gray-300">
        <thead class="bg-gray-100">
          <tr class="text-left">
            <th class="p-2 border">Medicine</th>
            <th class="p-2 border">Batch</th>
            <th class="p-2 border">Expiry</th>
            <th class="p-2 border">Qty</th>
            <th class="p-2 border">Price</th>
            <th class="p-2 border">Subtotal</th>
            <th class="p-2 border">Action</th>
          </tr>
        </thead>
        <tbody id="medicine-body">
          <!-- Initial Row -->
          <tr class="medicine-row">
            <td class="p-2 border">
              <select class="medicine-select w-full">
                <option value="">Select</option>
                <option value="Paracetamol" data-price="10">Paracetamol</option>
                <option value="Amoxicillin" data-price="20">Amoxicillin</option>
                <option value="Ibuprofen" data-price="15">Ibuprofen</option>
              </select>
            </td>
            <td class="p-2 border"><input type="text" class="batch border w-full p-1" value="B01" /></td>
            <td class="p-2 border"><input type="text" class="expiry border w-full p-1" value="12/2025" /></td>
            <td class="p-2 border"><input type="number" class="qty border w-full p-1" value="1" /></td>
            <td class="p-2 border"><input type="number" class="price border w-full p-1" readonly /></td>
            <td class="p-2 border"><input type="number" class="subtotal border w-full p-1" readonly /></td>
            <td class="p-2 border text-center">
              <button class="remove-row text-red-500">🗑</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <button id="add-row" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Medicine</button>

    <!-- Summary -->
    <div class="text-right space-y-2">
      <p>Total Items: <span id="total-items">1</span></p>
      <p>Total Amount: ₹<span id="total-amount">0</span></p>
      <button class="bg-green-600 text-white px-6 py-2 rounded">Save & Print</button>
    </div>
  </div>

  <script>
    function updateRow(row) {
      const qty = parseInt(row.find('.qty').val()) || 0;
      const price = parseFloat(row.find('.price').val()) || 0;
      row.find('.subtotal').val((qty * price).toFixed(2));
      updateSummary();
    }

    function updateSummary() {
      let total = 0;
      let count = 0;
      $('.medicine-row').each(function () {
        total += parseFloat($(this).find('.subtotal').val()) || 0;
        count++;
      });
      $('#total-amount').text(total.toFixed(2));
      $('#total-items').text(count);
    }

    function initSelect2(context) {
      context.find('.medicine-select').select2({
        placeholder: "Search medicine...",
        width: 'resolve'
      }).on('change', function () {
        const selected = $(this).find('option:selected');
        const price = selected.data('price') || 0;
        const row = $(this).closest('tr');
        row.find('.price').val(price);
        updateRow(row);
      });
    }

    $(document).ready(function () {
      initSelect2($('.medicine-row'));

      $('#medicine-body').on('input', '.qty', function () {
        const row = $(this).closest('tr');
        updateRow(row);
      });

      $('#add-row').on('click', function () {
        const newRow = $('.medicine-row').first().clone();
        newRow.find('input').val('');
        newRow.find('.select2-container').remove(); // remove old Select2
        newRow.find('.medicine-select').show().removeAttr('data-select2-id');
        $('#medicine-body').append(newRow);
        initSelect2(newRow);
        updateSummary();
      });

      $('#medicine-body').on('click', '.remove-row', function () {
        if ($('.medicine-row').length > 1) {
          $(this).closest('tr').remove();
          updateSummary();
        }
      });
    });
  </script>
</body>
</html>
