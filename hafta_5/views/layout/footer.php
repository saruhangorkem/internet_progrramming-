</div>
    </div>
    
    <div id="generalModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle"></h3>
            </div>
            <div class="modal-body" id="modalBody">
                Modal İçeriği
            </div>
            <div class="modal-footer" id="modalFooter">
                <button class="btn btn-secondary" onclick="closeModal()">Kapat</button>
            </div>
        </div>
    </div>
    
    <script>
        // Modal Yönetim Fonksiyonları
        const modal = document.getElementById('generalModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalBody = document.getElementById('modalBody');
        const modalFooter = document.getElementById('modalFooter');

        function openModal(title, body, footer = null) {
            modalTitle.innerHTML = title;
            modalBody.innerHTML = body;
            modalFooter.innerHTML = footer || '<button class="btn btn-secondary" onclick="closeModal()">Kapat</button>';
            modal.classList.add('open');
        }

        function closeModal() {
            modal.classList.remove('open');
        }

        // Global Event: Tüm Silme Butonları için Modal kullan
        document.querySelectorAll('.btn-delete-modal').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                openModal(
                    '🗑️ Kaydı Silme Onayı',
                    'Bu işlemi geri alamazsınız. **' + (this.dataset.name || 'Bu kaydı') + '** silmek istediğinizden emin misiniz?',
                    '<a href="' + url + '" class="btn btn-danger">Evet, Sil</a> <button class="btn btn-secondary" onclick="closeModal()">İptal</button>'
                );
            });
        });
    </script>
</body>
</html>