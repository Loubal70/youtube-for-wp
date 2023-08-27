import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
    return (
        <p { ...useBlockProps() }>
            { __(
                'Youtube For WP - This block will show last videos of your channels, don\'t forget to set your API key in the plugin settings.',
                'youtube-for-wp'
            ) }
        </p>
    );
}