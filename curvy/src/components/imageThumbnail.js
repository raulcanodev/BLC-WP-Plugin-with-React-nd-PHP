import { useImage } from "../hooks/useImage";

export const ImageThumbnail = (props) => {
	const image = useImage(props.imageId);

	return image?.source_url ? (
		<img
			src={image.source_url}
			style={{
				display: "block",
				height: props.height || 150,
				width: "100%",
				objectFit: "cover",
			}}
			onClick={props.onClick}
			className={props.className}
		/>
	) : null;
};
