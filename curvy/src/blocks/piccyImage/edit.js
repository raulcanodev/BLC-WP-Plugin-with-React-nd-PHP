import {
	useBlockProps,
	MediaUploadCheck,
	MediaUpload,
} from "@wordpress/block-editor";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPanorama } from "@fortawesome/free-solid-svg-icons";

import "./editor.scss";
import { __ } from "@wordpress/i18n";
import metadata from "./block.json";
import { useSelect } from "@wordpress/data";
import { ImageThumbnail } from "../../components/imageThumbnail";
import { useImage } from "../../hooks/useImage";

// Para que los iconos FontAwesome no se vean gigantes
import { config } from "@fortawesome/fontawesome-svg-core";
import "@fortawesome/fontawesome-svg-core/styles.css";
config.autoAddCss = false;

export default function Edit(props) {
	const blockProps = useBlockProps();
	const image = useImage(props.attributes.imageId);
	const imageSelected = props.attributes.imageId && image?.source_url;
	console.log({ image });

	return (
		<div {...blockProps}>
			{imageSelected && <ImageThumbnail imageId={props.attributes.imageId} />}
			{!imageSelected && (
				<div
					style={{
						height: 150,
						width: "100%",
						background: "white",
						display: "flex",
					}}
				>
					<FontAwesomeIcon
						icon={faPanorama}
						style={{
							margin: "auto",
							zIndex: "100", // Ajusta el valor de zIndex según sea necesario
						}}
					/>
				</div>
			)}
			<MediaUploadCheck>
				<MediaUpload
					allowedTypes={["image"]}
					render={({ open }) => {
						return (
							<button onClick={open} className="media-select">
								{imageSelected
									? __("Replace image", metadata.textdomain)
									: __("Select an image", metadata.textdomain)}
							</button>
						);
					}}
					value={props.attributes.imageId}
					onSelect={(item) => {
						props.setAttributes({ imageId: item.id });
					}}
				/>
			</MediaUploadCheck>
		</div>
	);
}
