@php
    $faqRows = old('faqs', isset($policy) ? ($policy->faqs ?? []) : []);
@endphp

<div class="card border-0 bg-light mt-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-1">Frequently Asked Questions</h5>
                <p class="text-muted small mb-0">Manage the FAQs displayed on this airline policy page.</p>
            </div>
            <button type="button" class="btn btn-outline-primary" id="add-faq">
                <i class="fas fa-plus me-2"></i>Add FAQ
            </button>
        </div>

        <div id="faq-list">
            @foreach($faqRows as $faq)
                <div class="faq-row border rounded-3 bg-white p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="faq-number">FAQ {{ $loop->iteration }}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-faq"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Question *</label>
                        <input type="text" class="form-control faq-question" value="{{ $faq['question'] ?? '' }}" maxlength="500" required>
                    </div>
                    <div>
                        <label class="form-label fw-bold">Answer *</label>
                        <textarea class="form-control faq-answer" rows="3" maxlength="5000" required>{{ $faq['answer'] ?? '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="faq-empty" class="text-center text-muted border rounded-3 bg-white p-4 {{ count($faqRows) ? 'd-none' : '' }}">
            No custom FAQs yet. The website will use the default FAQs until you add one.
        </div>
    </div>
</div>

<template id="faq-template">
    <div class="faq-row border rounded-3 bg-white p-3 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <strong class="faq-number"></strong>
            <button type="button" class="btn btn-sm btn-outline-danger remove-faq"><i class="fas fa-trash"></i></button>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Question *</label>
            <input type="text" class="form-control faq-question" maxlength="500" required>
        </div>
        <div>
            <label class="form-label fw-bold">Answer *</label>
            <textarea class="form-control faq-answer" rows="3" maxlength="5000" required></textarea>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const list = document.getElementById('faq-list');
        const empty = document.getElementById('faq-empty');
        const template = document.getElementById('faq-template');

        function refreshFaqs() {
            const rows = list.querySelectorAll('.faq-row');
            empty.classList.toggle('d-none', rows.length > 0);

            rows.forEach(function (row, index) {
                row.querySelector('.faq-number').textContent = `FAQ ${index + 1}`;
                row.querySelector('.faq-question').name = `faqs[${index}][question]`;
                row.querySelector('.faq-answer').name = `faqs[${index}][answer]`;
            });
        }

        document.getElementById('add-faq').addEventListener('click', function () {
            list.appendChild(template.content.cloneNode(true));
            refreshFaqs();
            list.lastElementChild.querySelector('.faq-question').focus();
        });

        list.addEventListener('click', function (event) {
            const removeButton = event.target.closest('.remove-faq');
            if (! removeButton) return;
            removeButton.closest('.faq-row').remove();
            refreshFaqs();
        });

        refreshFaqs();
    });
</script>
