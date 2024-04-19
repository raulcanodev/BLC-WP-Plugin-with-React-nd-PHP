import { PanelBody, SelectControl } from "@wordpress/components";
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from "@wordpress/block-editor";
import { useSelect } from "@wordpress/data";

export default function Edit(props) {
	const postTypes = useSelect((select) => {
		const data = select("core").getEntityRecords("root", "postType", {
			per_page: -1,
		});
		return data?.filter(
			(item) => item.visibility.show_in_nav_menus && item.visibility.show_ui,
		);
	});
	console.log({ postTypes });

	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title="Destination">
					<SelectControl
						label="Type"
						value={props.attributes.postTypes}
						onChange={(newValue) => {
							props.setAttributes({ postTypes: newValue });
						}}
						options={[
							{
								label: "Select a post type...",
								value: "",
							},
							...(postTypes || []).map((postType) => ({
								label: postType.labels.singular_name,
								value: postType.slug,
							})),
						]}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<RichText
					placeholder="Label text"
					value={props.attributes.labelText}
					allowedFormats={[]}
					multiline={false}
					onChange={(newValue) => {
						props.setAttributes({ labelText: newValue });
					}}
				/>
			</div>
		</>
	);
}
