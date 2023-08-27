import { useBlockProps } from '@wordpress/block-editor';
export default function save() {
    return (
        <p { ...useBlockProps.save() }>
            { 'Youtube For WP – hello from the saved content!' }
        </p>
    );
}