{{-- CSS Fixes for Filament Z-Index Issues --}}
    <style>
        .tox-tinymce {
            z-index: 1000 !important;
            border-radius: 0.5rem !important; 
        }
        
        .tox-tinymce-aux {
            z-index: 999999 !important; 
        }

        .tox-dialog-wrap {
            z-index: 999999 !important;
        }
        
        .tox-promotion {
            display: none !important;
        }
        
    
        .tox-statusbar__branding {
            display: none !important;
        }
    </style>


<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ 
            state: $wire.$entangle('{{ $field->getStatePath() }}'), 
            initialized: false,
            initEditor() {
                if (this.initialized) return;

                if (window.tinymce) {
                    // Check if instance already exists on this element
                    const existingEditor = tinymce.get(this.$refs.tinymce);
                    if (existingEditor) {
                        existingEditor.remove();
                    }
                    
                    tinymce.init({
                        target: this.$refs.tinymce,
                        height: 500,
                        menubar: true,
                        
                        // === LOCAL CONFIGURATION START ===
                        base_url: '{{ asset('js/tinymce') }}', 
                        suffix: '.min', 
                        license_key: 'gpl', 
                        // === LOCAL CONFIGURATION END ===

                        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                        toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image | help',
                        
                        automatic_uploads: true,
                        file_picker_types: 'image',
                        images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                            const reader = new FileReader();
                            reader.readAsDataURL(blobInfo.blob());
                            reader.onload = () => resolve(reader.result);
                            reader.onerror = () => reject('Image upload failed');
                        }),

                        setup: (editor) => {
                            editor.on('init', () => {
                                this.initialized = true;
                                if (this.state) {
                                    editor.setContent(this.state);
                                }
                            });
                            
                            // Using blur for syncing prevents too many updates, generally preferred for heavy editors
                            // But change is safer for immediate feedback if needed. 
                            editor.on('blur change', () => {
                                const content = editor.getContent();
                                // Only update if content changed to avoid loop
                                if (this.state !== content) {
                                    this.state = content;
                                }
                            });
                        }
                    });
                } else {
                    setTimeout(() => this.initEditor(), 50);
                }
            }
        }"
        x-init="
            if (!window.tinymce) {
                // Check if script is already loading to prevent duplicates
                if (!document.getElementById('tinymce-script')) {
                    const script = document.createElement('script');
                    script.id = 'tinymce-script';
                    script.src = '{{ asset('js/tinymce/tinymce.min.js') }}'; 
                    document.head.appendChild(script);
                }
                
                // Wait for it to load
                const checkTinyMce = setInterval(() => {
                    if (window.tinymce) {
                        clearInterval(checkTinyMce);
                        initEditor();
                    }
                }, 100);
            } else {
                initEditor();
            }
        "
        wire:ignore
        class="w-full"
    >
        <textarea x-ref="tinymce" class="hidden"></textarea>
    </div>

    <style>
        .tox-tinymce { z-index: 9999 !important; }
        .tox-dialog-wrap { z-index: 10000 !important; }
    </style>
</x-dynamic-component>