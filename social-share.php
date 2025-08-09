$post_url   = urlencode( get_permalink() );
$post_title = urlencode( get_the_title() );

$facebook_url = "https://www.facebook.com/sharer/sharer.php?u=$post_url";
$x_url        = "https://twitter.com/intent/tweet?url=$post_url&text=$post_title";
$linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=$post_url&title=$post_title";
$whatsapp_url = "https://api.whatsapp.com/send?text=$post_title%20$post_url";

$social_buttons = '
            <div class="social-share-buttons">
                <a class="social-button" href="' . esc_url( $facebook_url ) . '" target="_blank" aria-label="Share on Facebook" rel="noopener">
                    <svg width="24" height="24" viewBox="0 0 24 24"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.413c0-3.1 1.894-4.785 4.659-4.785 1.325 0 2.464.099 2.794.143v3.24h-1.918c-1.504 0-1.794.714-1.794 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.675V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                </a>
                <a class="social-button" href="' . esc_url( $x_url ) . '" target="_blank" aria-label="Share on X" rel="noopener">
<svg width="24" height="24" viewBox="0 0 1200 1227" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z" />
</svg>
                </a>
                <a class="social-button" href="' . esc_url( $linkedin_url ) . '" target="_blank" aria-label="Share on LinkedIn" rel="noopener">
                    <svg width="24" height="24" viewBox="0 0 24 24"><path d="M22.23 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.46C23.21 24 24 23.23 24 22.27V1.73C24 .77 23.21 0 22.23 0zM7.12 20.45H3.56V9.02h3.56v11.43zM5.34 7.65c-1.14 0-2.06-.92-2.06-2.06 0-1.14.92-2.06 2.06-2.06s2.06.92 2.06 2.06c0 1.14-.92 2.06-2.06 2.06zM20.45 20.45h-3.56v-5.84c0-1.39-.03-3.18-1.94-3.18-1.94 0-2.24 1.51-2.24 3.07v5.95H9.02V9.02h3.42v1.56h.05c.48-.91 1.66-1.87 3.42-1.87 3.65 0 4.33 2.4 4.33 5.52v6.22z"/></svg>
                </a>
 <a class="social-button" href="' . esc_url($whatsapp_url) . '" target="_blank" aria-label="Share on WhatsApp" rel="noopener">
                <svg width="24" height="24" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </a>
            </div>
        ';

echo $social_buttons;

// Styles for the social sharing buttons.
echo '
    <style>
        .social-share-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .social-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #f1f1f1;
            border-radius: 5px;
            text-decoration: none;
        }
        .social-button svg {
            fill: #555;
        }
        .social-button:hover svg {
            fill: #000;
        }
    </style>
    ';
